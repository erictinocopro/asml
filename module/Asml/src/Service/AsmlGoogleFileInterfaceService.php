<?php

namespace Asml\Service;

class AsmlGoogleFileInterfaceService
{

    private $configArr = [];
    private $results = [];

    const ROOT_FOLDER_ID = '0B26XFz92QvbaS2FnTGE2dXFpV0k';
    const OWNER = 'eric.tinoco.pro@gmail.com';

    public function __construct($config)
    {
        date_default_timezone_set('UTC');
        $this->configArr = $config;
    }

    public function createFolder($folderName)
    {
        $foldId = self::ROOT_FOLDER_ID;
        $driveService = $this->getGoogleFileService();
        $newFolder = new \Google_Service_Drive_DriveFile([
            'name' => $folderName,
            'parents' => [$foldId,],
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);
        $newFolder->setName($folderName);
        $newFolder->setOwners(self::OWNER);

        $folder = $driveService->files->create($newFolder
            , ['mimeType' => 'application/vnd.google-apps.folder']
        );
        return $this->getObjectId($folderName);	
    }

    public function createFile($fileName, $content, $fileType, $parentFolder=null)
    {
        $foldId = is_null($parentFolder) ? self::ROOT_FOLDER_ID : $parentFolder;
        $driveService = $this->getGoogleFileService();
        $newFolder = new \Google_Service_Drive_DriveFile([
            'name' => $fileName,
            'parents' => [$foldId,],
            'mimeType' => $fileType,
        ]);
        $newFolder->setName($fileName);
        $newFolder->setOwners(self::OWNER);

        $folder = $driveService->files->create($newFolder
            , ['data' => $content,
            'mimeType' => $fileType,
        ]
    );
        return $this->getObjectId($fileName);	
    }


    public function getObjectId($objectName, $driveService=null)
    {
        if (is_null($driveService)) {

            $driveService = $this->getGoogleFileService();
        }
        $response = $driveService->files->listFiles(array(
            'q' => "name='".$objectName."'",
            'spaces' => 'drive',
            'pageToken' => null,
        ));
        if (empty($response['files'][0]) || !  $response['files'][0] InstanceOf \Google_Service_Drive_DriveFile) {

            throw new \Exception('unable to get object', -1);
        }
        return $response['files'][0]->id;
    }

    private function getGoogleFileService()
    {
        $client = $this->getGoogleClient();
        return new \Google_Service_Drive($client);
    }

    private function getGoogleClient()
    {
        $config = $this->configArr['google']['auth'];
        $credentialsFile = $config['service-accounts']['spreadsheet']['keyFilePath'];

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsFile);

        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("IntegrationsUsage");
        $client->addScope(\Google_Service_Drive::DRIVE);

        if ($client->isAccessTokenExpired()) {

            $client->refreshTokenWithAssertion();
        }
        return $client;
    }
}
