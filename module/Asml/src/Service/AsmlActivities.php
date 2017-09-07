<?php

namespace Asml\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\I18n\Translator\TranslatorInterface;
use Zend\Log\LoggerInterface;

class AsmlActivities extends AsmlAbstractService implements EventManagerAwareInterface
{

    	protected $logger;

    	public function __construct(
    	) {
    	}

	public function getSections($inputSectionType)
	{

    		switch ($inputSectionType) {
 
			case 'Enfants/Ados':
				$section = [
					[ 'value' => 'Danse  6-10 ans', 'html' => 'Danse  6-10 ans', ],
					[ 'value' => 'Danse 4-5 ans', 'html' => 'Danse 4-5 ans', ],
					[ 'value' => 'Danse 10-15 ans', 'html' => 'Danse 10-15 ans', ],
					[ 'value' => 'Break Dance 7-11 ans', 'html' => 'Break Dance 7-11 ans', ],
					[ 'value' => 'Break Dance Ados', 'html' => 'Break Dance Ados', ],
					[ 'value' => 'Gym Art du Cirque 5-7 ans', 'html' => 'Gym Art du Cirque 5-7 ans', ],
					[ 'value' => 'Gym Art du Cirque 6-12 ans', 'html' => 'Gym Art du Cirque 6-12 ans', ],
					[ 'value' => 'Baby Gym/Art du cirque 3-5 ans', 'html' => 'Baby Gym/Art du cirque 3-5 ans', ],
					[ 'value' => 'Baby Gym/Art du cirque 6-12 ans', 'html' => 'Baby Gym/Art du cirque 6-12 ans', ],
					[ 'value' => 'Conscience du corps/Eveil Yoga 5-11 ans', 'html' => 'Conscience du corps/Eveil Yoga 5-11 ans', ],
					[ 'value' => 'Gym Parent/Bébé (6 mois-3 ans)', 'html' => 'Gym Parent/Bébé (6 mois-3 ans)', ],
					[ 'value' => 'Multisports 7-11 ans', 'html' => 'Multisports 7-11 ans', ],
					[ 'value' => 'Multisports 5-7 ans', 'html' => 'Multisports 5-7 ans', ],
					[ 'value' => 'Multisports 4-5 ans', 'html' => 'Multisports 4-5 ans', ],
					[ 'value' => 'Gymnastique Artistique 6-8 ans (niveau 1)', 'html' => 'Gymnastique Artistique 6-8 ans (niveau 1)', ],
					[ 'value' => 'Gymnastique Artistique 8-15 ans (niveau 2)', 'html' => 'Gymnastique Artistique 8-15 ans (niveau 2)', ],
					[ 'value' => 'Gymnastique Artistique 3-5 ans', 'html' => 'Gymnastique Artistique 3-5 ans', ],
					[ 'value' => 'Capoeira 6-11 ans', 'html' => 'Capoeira 6-11 ans', ],
					[ 'value' => 'Capoiera Ados', 'html' => 'Capoiera Ados', ],
					[ 'value' => 'Motricité/Concentration 6-11 ans', 'html' => 'Motricité/Concentration 6-11 ans', ],
					[ 'value' => 'Motricité/Concentration Ados/Parents', 'html' => 'Motricité/Concentration Ados/Parents', ],
					[ 'value' => 'Dance Fit 7-10 ans', 'html' => 'Dance Fit 7-10 ans', ],
					[ 'value' => 'Dance Fit Ados', 'html' => 'Dance Fit Ados', ],
					[ 'value' => 'Danse Orientale', 'html' => 'Danse Orientale', ],
					[ 'value' => 'Sunday Mix 1 Ados Cardio-Renfo (Zumba, Dance Fit, Piloxing…)', 'html' => 'Sunday Mix 1 Ados Cardio-Renfo (Zumba, Dance Fit, Piloxing…)', ],
					[ 'value' => 'Sunday Mix 2 Adox Renfo-Gainage (Pilate, Body zen, Circuit training…)', 'html' => 'Sunday Mix 2 Adox Renfo-Gainage (Pilate, Body zen, Circuit training…)', ],
					[ 'value' => 'Préparation aux examens (10 séances) A compter de Mars', 'html' => 'Préparation aux examens (10 séances) A compter de Mars', ],
				];
				break;
			case 'Adultes':
				$section = [
					[ 'value' => 'Capoiera', 'html' => 'Capoiera', ],
					[ 'value' => 'Danse Orientale', 'html' => 'Danse Orientale', ],
					[ 'value' => 'Box\'Fit', 'html' => 'Box\'Fit', ],
					[ 'value' => 'Zumba Dance', 'html' => 'Zumba Dance', ],
					[ 'value' => 'Cardio Latino', 'html' => 'Cardio Latino', ],
					[ 'value' => 'Step', 'html' => 'Step', ],
					[ 'value' => 'Body Zen/Circuit Training', 'html' => 'Body Zen/Circuit Training', ],
					[ 'value' => 'Body Sculpt', 'html' => 'Body Sculpt', ],
					[ 'value' => 'Gym Fitness', 'html' => 'Gym Fitness', ],
					[ 'value' => 'Sunday Mix 1 Cardio-Renfo (Zumba, Dance Fit, Piloxing…)', 'html' => 'Sunday Mix 1 Cardio-Renfo (Zumba, Dance Fit, Piloxing…)', ],
					[ 'value' => 'Sunday Mix 2 Renfo-Gainage (Pilates, Body zen, Circuit training…)', 'html' => 'Sunday Mix 2 Renfo-Gainage (Pilates, Body zen, Circuit training…)', ],
					[ 'value' => 'Pilates', 'html' => 'Pilates', ],
					[ 'value' => 'Dance Fit', 'html' => 'Dance Fit', ],
					[ 'value' => 'Yoga', 'html' => 'Yoga', ],
					[ 'value' => 'Harmonie du corps', 'html' => 'Harmonie du corps', ],
					[ 'value' => 'Gestion du stress / Relaxation / DO IN', 'html' => 'Gestion du stress / Relaxation / DO IN', ],
					[ 'value' => 'Stretching / Relaxation', 'html' => 'Stretching / Relaxation', ],
					[ 'value' => 'Gym Active', 'html' => 'Gym Active', ],
					[ 'value' => 'Gym Tonique', 'html' => 'Gym Tonique', ],
					[ 'value' => 'Gym Oxygène (Marche et Renfo)', 'html' => 'Gym Oxygène (Marche et Renfo)', ],
					[ 'value' => 'Marche Nordique', 'html' => 'Marche Nordique', ],
					[ 'value' => 'Salsa, Tango argentin, Rock, Bachata (4 séances)', 'html' => 'Salsa, Tango argentin, Rock, Bachata (4 séances)', ],
					[ 'value' => 'Relaxation musculaire et Equilibre', 'html' => 'Relaxation musculaire et Equilibre', ],
					[ 'value' => 'Sophrologie niveau 1 (12 séances)', 'html' => 'Sophrologie niveau 1 (12 séances)', ],
					[ 'value' => 'Sophrologie niveau 2 (12 séances)', 'html' => 'Sophrologie niveau 2 (12 séances)', ],
				];
				break;
			case 'Seniors':
				$section = [
					[ 'value' => 'Yoga', 'html' => 'Yoga', ],
					[ 'value' => 'Gym Douce', 'html' => 'Gym Douce', ],
					[ 'value' => 'Gym Active', 'html' => 'Gym Active', ],
					[ 'value' => 'Marche Nordique', 'html' => 'Marche Nordique', ],
				];
				break;
			default:
				$section = [];
		}
		return $section;
	}

	public function getActivities( $inputActivityType )
	{

		$activite['Danse  6-10 ans'][] = [ 'value' => base64_encode('Mardi-18h15 à 19h15-Gymnase Ferdinand Buisson'), 'html' => 'Le Mardi de 18h15 à 19h15 - Gymnase Ferdinand Buisson', 'prix' => 174, ];
		$activite['Danse 4-5 ans'][] = [ 'value' => base64_encode('Jeudi-17h20 à 18h05 -Gymnase Ferdinand Buisson'), 'html' => 'Le Jeudi de 17h20 à 18h05  - Gymnase Ferdinand Buisson', 'prix' => 165, ];
		$activite['Danse 10-15 ans'][] = [ 'value' => base64_encode('Jeudi-18h15 à 19h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Jeudi de 18h15 à 19h30 - Gymnase Ferdinand Buisson', 'prix' => 237, ];
		$activite['Break Dance 7-11 ans'][] = [ 'value' => base64_encode('Lundi-17h15 à 18h15-Gymnase Ferdinand Buisson'), 'html' => 'Le Lundi de 17h15 à 18h15 - Gymnase Ferdinand Buisson', 'prix' => 186, ];
		$activite['Break Dance Ados'][] = [ 'value' => base64_encode('Lundi-18h15 à 19h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Lundi de 18h15 à 19h30 - Gymnase Ferdinand Buisson', 'prix' => 237, ];
		$activite['Gym Art du Cirque 5-7 ans'][] = [ 'value' => base64_encode('Mercredi-13h35 à 14h35-Gymnase Ferdinand Buisson'), 'html' => 'Le Mercredi de 13h35 à 14h35 - Gymnase Ferdinand Buisson', 'prix' => 174, ];
		$activite['Gym Art du Cirque 6-12 ans'][] = [ 'value' => base64_encode('Lundi-18h15 à 19h15 -Gymnase Ferdinand Buisson'), 'html' => 'Le Lundi de 18h15 à 19h15  - Gymnase Ferdinand Buisson', 'prix' => 186, ];
		$activite['Baby Gym/Art du cirque 3-5 ans'][] = [ 'value' => base64_encode('Lundi -17h à 18h -Gymnase Ferdinand Buisson'), 'html' => 'Le Lundi  de 17h à 18h  - Gymnase Ferdinand Buisson', 'prix' => 174, ];
		$activite['Baby Gym/Art du cirque 6-12 ans'][] = [ 'value' => base64_encode('Mercredi-14h40 à 15h40-Gymnase Ferdinand Buisson'), 'html' => 'Le Mercredi de 14h40 à 15h40 - Gymnase Ferdinand Buisson', 'prix' => 174, ];
		$activite['Conscience du corps/Eveil Yoga 5-11 ans'][] = [ 'value' => base64_encode('Lundi-15h45 à 16h45 -Salle Flow'), 'html' => 'Le Lundi de 15h45 à 16h45  - Salle Flow', 'prix' => 198, ];
		$activite['Conscience du corps/Eveil Yoga 5-11 ans'][] = [ 'value' => base64_encode('Lundi-17h15 à 18h15 -Salle Flow'), 'html' => 'Le Lundi de 17h15 à 18h15  - Salle Flow', 'prix' => 198, ];
		$activite['Conscience du corps/Eveil Yoga 5-11 ans'][] = [ 'value' => base64_encode('Jeudi-15h45 à 16h45 -Salle Flow'), 'html' => 'Le Jeudi de 15h45 à 16h45  - Salle Flow', 'prix' => 198, ];
		$activite['Conscience du corps/Eveil Yoga 5-11 ans'][] = [ 'value' => base64_encode('Jeudi-17h30 à 18h30 -Salle Flow'), 'html' => 'Le Jeudi de 17h30 à 18h30  - Salle Flow', 'prix' => 198, ];
		//$activite['Gym Parent/Bébé (6 mois-3 ans)'][] = [ 'value' => base64_encode('Samedi-17h15 à 18h-Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 17h15 à 18h - Gymnase Les Pierres Vives', 'prix' => , ];
		$activite['Multisports 7-11 ans'][] = [ 'value' => base64_encode('Mercredi-13h30 à 15h   -Gymnase Ferdinand Buisson'), 'html' => 'Le Mercredi de 13h30 à 15h    - Gymnase Ferdinand Buisson', 'prix' => 237, ];
		$activite['Multisports 5-7 ans'][] = [ 'value' => base64_encode('Mercredi-15h à 16h15  -Gymnase Ferdinand Buisson'), 'html' => 'Le Mercredi de 15h à 16h15   - Gymnase Ferdinand Buisson', 'prix' => 186, ];
		$activite['Multisports 4-5 ans'][] = [ 'value' => base64_encode('Jeudi-16h15 à 17h -Gymnase Ferdinand Buisson'), 'html' => 'Le Jeudi de 16h15 à 17h  - Gymnase Ferdinand Buisson', 'prix' => 174, ];
		$activite['Gymnastique Artistique 6-8 ans (niveau 1)'][] = [ 'value' => base64_encode('Samedi-14h à 15h-Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 14h à 15h - Gymnase Les Pierres Vives', 'prix' => 186, ];
		$activite['Gymnastique Artistique 8-15 ans (niveau 2)'][] = [ 'value' => base64_encode('Samedi-15h à 16h -Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 15h à 16h  - Gymnase Les Pierres Vives', 'prix' => 186, ];
		$activite['Gymnastique Artistique 3-5'][] = [ 'value' => base64_encode('Samedi-16h15 à 17h -Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 16h15 à 17h  - Gymnase Les Pierres Vives', 'prix' => 174, ];
		$activite['Capoeira 6-11 ans'][] = [ 'value' => base64_encode('Jeudi-18h à 19h-Dojo Cosec Pablo Picasso'), 'html' => 'Le Jeudi de 18h à 19h - Dojo Cosec Pablo Picasso', 'prix' => 198, ];
		$activite['Capoiera Ados'][] = [ 'value' => base64_encode('Jeudi-19h à 20h30-Dojo Cosec Pablo Picasso'), 'html' => 'Le Jeudi de 19h à 20h30 - Dojo Cosec Pablo Picasso', 'prix' => 228, ];
		$activite['Motricité/Concentration 6-11 ans'][] = [ 'value' => base64_encode('Vendredi-17h30 à 18h45-Salle Relais St Louis'), 'html' => 'Le Vendredi de 17h30 à 18h45 - Salle Relais St Louis', 'prix' => 228, ];
		$activite['Motricité/Concentration Ados/Parents'][] = [ 'value' => base64_encode('Dimanche-10h30 à 12h-'), 'html' => 'Le Dimanche de 10h30 à 12h -', 'prix' => 228, ];
		$activite['Dance Fit 7-10 ans'][] = [ 'value' => base64_encode('Mardi-17h15 à 18h15   -Gymnase Ferdinand Buisson'), 'html' => 'Le Mardi de 17h15 à 18h15    - Gymnase Ferdinand Buisson', 'prix' => 186, ];
		$activite['Dance Fit Ados'][] = [ 'value' => base64_encode('-18h45 à 19h30 -Dojo Cosec Pablo Picasso'), 'html' => 'Le  de 18h45 à 19h30  - Dojo Cosec Pablo Picasso', 'prix' => 186, ];
		$activite['Danse Orientale'][] = [ 'value' => base64_encode('Vendredi-20h30 à 21h45 -Gymnase Théophile Roussel  '), 'html' => 'Le Vendredi de 20h30 à 21h45  - Gymnase Théophile Roussel', 'prix' => 249, ];
		$activite['Sunday Mix 1 Ados Cardio-Renfo (Zumba, Dance Fit, Piloxing…)'][] = [ 'value' => base64_encode('Dimanche-10h30-11h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Dimanche de 10h30-11h30 - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Sunday Mix 2 Adox Renfo-Gainage (Pilate, Body zen, Circuit training…)'][] = [ 'value' => base64_encode('Dimanche-11h30-12h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Dimanche de 11h30-12h30 - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Préparation aux examens (10 séances) A compter de Mars'][] = [ 'value' => base64_encode('Mercredi-17h à 18h -Salle Flow'), 'html' => 'Le Mercredi de 17h à 18h  - Salle Flow', 'prix' => 150, ];
		$activite['Capoiera'][] = [ 'value' => base64_encode('Jeudi-19h à 20h30-Dojo Cosec Pablo Picasso'), 'html' => 'Le Jeudi de 19h à 20h30 - Dojo Cosec Pablo Picasso', 'prix' => 228, ];
		$activite['Danse Orientale'][] = [ 'value' => base64_encode('Vendredi-20h30 à 21h45 -Gymnase Théophile Roussel  '), 'html' => 'Le Vendredi de 20h30 à 21h45  - Gymnase Théophile Roussel', 'prix' => 249, ];
		$activite['Box\'Fit'][] = [ 'value' => base64_encode('Mardi-19h30 à 20h30 -Dojo Cosec Pablo Picasso'), 'html' => 'Le Mardi de 19h30 à 20h30  - Dojo Cosec Pablo Picasso', 'prix' => 198, ];
		$activite['Box\'Fit'][] = [ 'value' => base64_encode('Mardi-20h30 à 21h30-Dojo Cosec Pablo Picasso'), 'html' => 'Le Mardi de 20h30 à 21h30 - Dojo Cosec Pablo Picasso', 'prix' => 198, ];
		$activite['Box\'Fit'][] = [ 'value' => base64_encode('Jeudi-20h30 à 21h30-Dojo Cosec Pablo Picasso'), 'html' => 'Le Jeudi de 20h30 à 21h30 - Dojo Cosec Pablo Picasso', 'prix' => 198, ];
		$activite['Zumba Dance'][] = [ 'value' => base64_encode('Lundi-19h30 à 20h30 -Gymnase Ferdinand Buisson'), 'html' => 'Le Lundi de 19h30 à 20h30  - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		//$activite['Cardio Latino'][] = [ 'value' => base64_encode('Mardi-19h30 à 20h30 -'), 'html' => 'Le Mardi de 19h30 à 20h30  -', 'prix' => , ];
		$activite['Step'][] = [ 'value' => base64_encode('Jeudi-20h30 à 21h30-Gymnase Jules Verne'), 'html' => 'Le Jeudi de 20h30 à 21h30 - Gymnase Jules Verne', 'prix' => 198, ];
		//$activite['Body Zen/Circuit Training'][] = [ 'value' => base64_encode('Jeudi-21h30 à 22h30-Gymnase Jules Verne'), 'html' => 'Le Jeudi de 21h30 à 22h30 - Gymnase Jules Verne', 'prix' => , ];
		$activite['Body Sculpt'][] = [ 'value' => base64_encode('Jeudi-19h30 à 20h30 -Gymnase Ferdinand Buisson'), 'html' => 'Le Jeudi de 19h30 à 20h30  - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Gym Fitness'][] = [ 'value' => base64_encode('Mardi-19h15 à 20h15-Gymnase Ferdinand Buisson'), 'html' => 'Le Mardi de 19h15 à 20h15 - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Sunday Mix 1 Cardio-Renfo (Zumba, Dance Fit, Piloxing…)'][] = [ 'value' => base64_encode('Dimanche-10h30-11h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Dimanche de 10h30-11h30 - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Sunday Mix 2 Renfo-Gainage (Pilates, Body zen, Circuit training…)'][] = [ 'value' => base64_encode('Dimanche-11h30-12h30-Gymnase Ferdinand Buisson'), 'html' => 'Le Dimanche de 11h30-12h30 - Gymnase Ferdinand Buisson', 'prix' => 198, ];
		$activite['Pilates'][] = [ 'value' => base64_encode('Samedi-10h à 11h-Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 10h à 11h - Gymnase Les Pierres Vives', 'prix' => 228, ];
		$activite['Pilates'][] = [ 'value' => base64_encode('Samedi-11h à 12h-Gymnase Les Pierres Vives'), 'html' => 'Le Samedi de 11h à 12h - Gymnase Les Pierres Vives', 'prix' => 228, ];
		$activite['Pilates'][] = [ 'value' => base64_encode('Lundi-19h à 20h15-Gymnase Théophile Roussel  '), 'html' => 'Le Lundi de 19h à 20h15 - Gymnase Théophile Roussel', 'prix' => 249, ];
		$activite['Pilates'][] = [ 'value' => base64_encode('Lundi-20h15 à 21h30-Gymnase Théophile Roussel  '), 'html' => 'Le Lundi de 20h15 à 21h30 - Gymnase Théophile Roussel', 'prix' => 249, ];
		$activite['Dance Fit'][] = [ 'value' => base64_encode('Lundi-20h30 à 21h30-Gymnase Jules Verne'), 'html' => 'Le Lundi de 20h30 à 21h30 - Gymnase Jules Verne', 'prix' => 198, ];
		$activite['Dance Fit'][] = [ 'value' => base64_encode('Mercredi-19h30 à 20h30-Gymnase Théophile Roussel  '), 'html' => 'Le Mercredi de 19h30 à 20h30 - Gymnase Théophile Roussel', 'prix' => 198, ];
		$activite['Dance Fit'][] = [ 'value' => base64_encode('Mercredi-20h30 à 21h30-Gymnase Théophile Roussel  '), 'html' => 'Le Mercredi de 20h30 à 21h30 - Gymnase Théophile Roussel', 'prix' => 198, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-9h à 10h15-Salle Créadanse'), 'html' => 'Le Jeudi de 9h à 10h15 - Salle Créadanse', 'prix' => 249, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-10h15 à 11h30-Salle Créadanse'), 'html' => 'Le Jeudi de 10h15 à 11h30 - Salle Créadanse', 'prix' => 249, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-19h à 20h-Salle Léon Morane'), 'html' => 'Le Jeudi de 19h à 20h - Salle Léon Morane', 'prix' => 228, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-20h à 21h-Salle Léon Morane'), 'html' => 'Le Jeudi de 20h à 21h - Salle Léon Morane', 'prix' => 228, ];
		$activite['Harmonie du corps'][] = [ 'value' => base64_encode('Lundi-9h45 à 11h-Salle Coroze'), 'html' => 'Le Lundi de 9h45 à 11h - Salle Coroze', 'prix' => 299, ];
		$activite['Harmonie du corps'][] = [ 'value' => base64_encode('Lundi-20h30 à 21h45 -Salle Coroze'), 'html' => 'Le Lundi de 20h30 à 21h45  - Salle Coroze', 'prix' => 299, ];
		$activite['Harmonie du corps'][] = [ 'value' => base64_encode('Mardi-19h à 20h15-Salle Coroze'), 'html' => 'Le Mardi de 19h à 20h15 - Salle Coroze', 'prix' => 299, ];
		$activite['Harmonie du corps / Feldenkrais'][] = [ 'value' => base64_encode('Mardi-20h15 à 21h15-Salle Coroze'), 'html' => 'Le Mardi de 20h15 à 21h15 - Salle Coroze', 'prix' => 269, ];
		$activite['Gestion du stress / Relaxation / DO IN'][] = [ 'value' => base64_encode('Lundi-19h30 à 20h30-Salle Léon Morane'), 'html' => 'Le Lundi de 19h30 à 20h30 - Salle Léon Morane', 'prix' => 228, ];
		$activite['Stretching / Relaxation'][] = [ 'value' => base64_encode('Mardi-19h30 à 20h30-Salle Léon Morane'), 'html' => 'Le Mardi de 19h30 à 20h30 - Salle Léon Morane', 'prix' => 229, ];
		$activite['Gym Active'][] = [ 'value' => base64_encode('Lundi-11h à 12h-'), 'html' => 'Le Lundi de 11h à 12h -', 'prix' => 170, ];
		$activite['Gym Active'][] = [ 'value' => base64_encode('Vendredi-9h à 10h-'), 'html' => 'Le Vendredi de 9h à 10h -', 'prix' => 170, ];
		$activite['Gym Tonique'][] = [ 'value' => base64_encode('Lundi-9h à 10h-Salle Léon Morane'), 'html' => 'Le Lundi de 9h à 10h - Salle Léon Morane', 'prix' => 170, ];
		$activite['Gym Oxygène (Marche et Renfo)'][] = [ 'value' => base64_encode('Mercredi-9h30 à 10h30-Quai de Seine/Parcours santé'), 'html' => 'Le Mercredi de 9h30 à 10h30 - Quai de Seine/Parcours santé', 'prix' => 198, ];
		$activite['Gym Oxygène (Marche et Renfo)'][] = [ 'value' => base64_encode('Dimanche-10h30 à 11h30-Quai de Seine/Parcours santé'), 'html' => 'Le Dimanche de 10h30 à 11h30 - Quai de Seine/Parcours santé', 'prix' => 198, ];
		$activite['Marche Nordique'][] = [ 'value' => base64_encode('Samedi-10h30 à 12h-Forêt de Maisons Laffitte'), 'html' => 'Le Samedi de 10h30 à 12h - Forêt de Maisons Laffitte', 'prix' => 198, ];
		$activite['Salsa, Tango argentin, Rock, Bachata (4 séances)'][] = [ 'value' => base64_encode('Dimanche-10h à 13h-Gymnase Théophile Roussel  '), 'html' => 'Le Dimanche de 10h à 13h - Gymnase Théophile Roussel', 'prix' => 80, ];
		$activite['Relaxation musculaire et Equilibre'][] = [ 'value' => base64_encode('Jeudi-20h15 à 22h15-Salle Léon Morane'), 'html' => 'Le Jeudi de 20h15 à 22h15 - Salle Léon Morane', 'prix' => 228, ];
		$activite['Sophrologie niveau 1 (12 séances)'][] = [ 'value' => base64_encode('Samedi-10h15 à 11h15-Salle Flow'), 'html' => 'Le Samedi de 10h15 à 11h15 - Salle Flow', 'prix' => 180, ];
		$activite['Sophrologie niveau 2 (12 séances)'][] = [ 'value' => base64_encode('Samedi-11h30 à 12h30-Salle Flow'), 'html' => 'Le Samedi de 11h30 à 12h30 - Salle Flow', 'prix' => 180, ];

		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-9h à 10h15-Salle Créadanse'), 'html' => 'Le Jeudi de 9h à 10h15 - Salle Créadanse', 'prix' => 249, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-10h15 à 11h30-Salle Créadanse'), 'html' => 'Le Jeudi de 10h15 à 11h30 - Salle Créadanse', 'prix' => 249, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-19h à 20h-Salle Léon Morane'), 'html' => 'Le Jeudi de 19h à 20h - Salle Léon Morane', 'prix' => 228, ];
		$activite['Yoga'][] = [ 'value' => base64_encode('Jeudi-20h à 21h-Salle Léon Morane'), 'html' => 'Le Jeudi de 20h à 21h - Salle Léon Morane', 'prix' => 228, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Lundi-10h à 11h-Salle Lesage'), 'html' => 'Le Lundi de 10h à 11h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Mardi-14h à 15h-Salle Lesage'), 'html' => 'Le Mardi de 14h à 15h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Vendredi -10h à 11h-Salle Lesage'), 'html' => 'Le Vendredi  de 10h à 11h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Vendredi -11H à 12h-Salle Lesage'), 'html' => 'Le Vendredi  de 11H à 12h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Lundi-14h à 15h-Salle Lesage'), 'html' => 'Le Lundi de 14h à 15h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Douce'][] = [ 'value' => base64_encode('Lundi-15h à 16h-Salle Lesage'), 'html' => 'Le Lundi de 15h à 16h - Salle Lesage', 'prix' => 170, ];
		$activite['Gym Active'][] = [ 'value' => base64_encode('Lundi-11h à 12h-'), 'html' => 'Le Lundi de 11h à 12h -', 'prix' => 170, ];
		$activite['Gym Active'][] = [ 'value' => base64_encode('Vendredi-9h à 10h-'), 'html' => 'Le Vendredi de 9h à 10h -', 'prix' => 170, ];
		$activite['Marche Nordique'][] = [ 'value' => base64_encode('Samedi-10h30 à 12h-Forêt de Maisons Laffitte'), 'html' => 'Le Samedi de 10h30 à 12h - Forêt de Maisons Laffitte', 'prix' => 198, ];

		if (!empty($activite[$inputActivityType])) {

			return $activite[$inputActivityType];
		}
		return [];
	}
}
