<?php

namespace OpenAdmin\Library;

Class Notifier {

	public $classname 	= 'Notifier';
	
	private $n_alerts 	= 0;
	private $alerts 	= array();

	public function __construct() {
		
	}
	
	public function getNumberAlerts() {
		return $this->n_alerts;
	}
	
	public function getAlerts() {
		
		$alerts = '';
				
		for($i = 0; $i < $this->n_alerts; $i++) {
			$alerts .= 
			'<li>
				<div class="col app-notif">
					<div class="col-md-2" > ' . $this->typeAlertImage($this->alerts[$i]['type']) . ' </div>
					<div class="col-md-10" >
						<div style="font-weight: bold;">' . $this->typeAlertTitle($this->alerts[$i]['type']) . '</div>
						<div style="font-weight: normal;">' . $this->alerts[$i]['msg'] . '</div>
						<div style="font-weight: normal; font-size: 9px; text-align: right">' . $this->alerts[$i]['date'] . '</div>
					</div>
				</div>
			</li>';
		}
				
		return $alerts;
	}
	
	private function loadAlerts($offset) {
		
		$this->n_alerts = 5;
		
		for($i = 0; $i < $this->n_alerts; $i++) {
			$this->alerts[] = array(
				'type' => mt_rand(1, 5),
				'msg' => $this->randomMessage(mt_rand(5, 20), mt_rand(8, 12)),
				'read' => 0,
				'date' => date('d/m/Y H:i')
			);
		}
		
		return $this;
	}
	
	private function typeAlertImage($type) {
		
		switch ($type) {
			case 1 : return 'www/img/logo-gadafic.png'; break;
			case 2 : return 'www/img/personnal.png'; break;
			case 3 : return 'www/img/eleves-right.png'; break;
			case 4 : return 'www/img/historiqueprix.png'; break;
			case 5 : return 'www/img/personnal.png'; break;
		}
	}
	
	private function typeAlertTitle($type) {
		
		switch ($type) {
			case 1 : return 'Bienvenue sur OpenAdmin'; break;
			case 2 : return 'Retard de Paiement'; break;
			case 3 : return 'Ajout Eleves'; break;
			case 4 : return 'Paiement Eleves'; break;
			case 5 : return 'Règlement Enseignant'; break;
		}
	}
	
	private function randomMessage($nWords, $wordMaxLength) {
		
		$msg = '';
		for($i = 1; $i <= $nWords; $i++)
			$msg .= Utils::randomString($wordMaxLength) . '&nbsp;&nbsp;';
		
		return $msg;
	}
	
}

?>