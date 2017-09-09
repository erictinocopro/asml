<?php

namespace Asml\Service;

class AsmlGoogleXLInterfaceService
{

    private $configArr = [];
    private $results = [];

    public function __construct($config)
    {
        date_default_timezone_set('UTC');
        $this->configArr = $config;
    }

    public function publishResults($results)
    {
        try {

            $worksheetKeys = array_keys($results[0]);
            $newWorksheet = $this->createAndGetNewWorksheet(count($results), $worksheetKeys);

            $googleClient = $this->getGoogleClient();
            $service = new \Google_Service_Sheets($googleClient);
            $spreadsheetId = $this->configArr['google']['spreadsheetKey'];
            $valueInputOption = 'USER_ENTERED';

            $listFeed = $newWorksheet->getListFeed();
            if ($listFeed && $results) {

                $data = $this->prepareSheetData($results);
            }

            $requestBody = new \Google_Service_Sheets_BatchUpdateValuesRequest();
            $requestBody->setValueInputOption($valueInputOption);
            $requestBody->setData($data);

            $response = $service->spreadsheets_values->batchUpdate($spreadsheetId, $requestBody);

            // Deletes the old Worksheed, which is no longer actuall
        } catch (\Exception $e) {

            var_dump( $e->getMessage() . ' - ' . $e->getCode() ); 
        }
    }

    public function publishRow($rowResults)
    {
        try {

            $googleClient = $this->getGoogleClient();
            $service = new \Google_Service_Sheets($googleClient);
            $spreadsheetId = $this->configArr['google']['spreadsheetKey'];
            $valueInputOption = 'RAW';

            $valueRange= new \Google_Service_Sheets_ValueRange();
            $valueRange->setValues(["values" => $rowResults]);

            return $service->spreadsheets_values->append(
                $spreadsheetId
                , $this->configArr['google']['worksheet']
                , $valueRange
                , ["valueInputOption" => $valueInputOption]
                , ['insertDataOption' => 'INSERT_ROWS']
            );
        } catch (\Exception $e) {

            var_dump( $e->getMessage() . ' - ' . $e->getCode() ); 
        }
    }

    private function prepareSheetData($resultTotal)
    {
        $data = [];
        $values = [];
        $range_number = 1; // Keep spreadsheet header

        foreach ($resultTotal as $result) {
            $range_number++;
            $values[] = array_values($result);
        }

        $range = $this->configArr['google']['worksheet'] .
            '!' .
            $this->configArr['google']['worksheet-data-cells-range'] .
            (count($resultTotal) + 1);
        $data[] = new \Google_Service_Sheets_ValueRange(
            array('range' => $range, 'values' => $values, 'majorDimension' => 'ROWS')
        );
        return $data;
    }

    private function createAndGetNewWorksheet($numRowsToAdd, $worksheetKeys)
    {
        try {

            $config = $this->configArr['google'];
            $spreadsheetService = $this->getGoogleSpreadSheetService();
            $spreadsheet = $spreadsheetService->getSpreadsheetById($config['spreadsheetKey']);

            $worksheetFeed = $spreadsheet->getWorksheets();

            $oldWorkSheet = $worksheetFeed->getByTitle($config['worksheet']);
            if ($oldWorkSheet->getId()) {

                return $oldWorkSheet;
            }
            throw new \Exception('no sheet');
        } catch (\Google_Spreadsheet_Exception $gse) {
            throw $gse;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function getGoogleSpreadSheetService()
    {
        $client = $this->getGoogleClient();
        $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];

        $serviceRequest = new \Google_Spreadsheet_DefaultServiceRequest($accessToken);
        \Google_Spreadsheet_ServiceRequestFactory::setInstance($serviceRequest);
        return new \Google_Spreadsheet_SpreadsheetService();
    }

    private function getGoogleClient()
    {
        $config = $this->configArr['google']['auth'];
        $credentialsFile = $config['service-accounts']['spreadsheet']['keyFilePath'];

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsFile);

        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("IntegrationsUsage");
        $client->setScopes(['https://spreadsheets.google.com/feeds',]);

        if ($client->isAccessTokenExpired()) {
            $client->refreshTokenWithAssertion();
        }

        return $client;
    }
}
