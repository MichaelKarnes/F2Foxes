<?php
class Weather {
	private $_data;
	
	public function __construct() {
		$url = 'http://api.wunderground.com/api/74242ed029ebb79e/conditions/q/TX/College%20Station.json';
        $content = file_get_contents($url);
        $this->_data = json_decode($content, true);
	}

    public function getTempF() {
        return $this->_data['current_observation']['temp_f'];
    }

    public function getFeelsLikeF() {
        return $this->_data['current_observation']['feelslike_f'];
    }

    public function getIcon() {
        switch($this->_data['current_observation']['icon']) {
            case "chanceflurries":
            case "chancesleet":
            case "flurries":
            case "sleet":
            case "snow":
            case "nt_chanceflurries":
            case "nt_chancesleet":
            case "nt_flurries":
            case "nt_sleet":
            case "nt_snow":
                return "snowy";
            case "chancerain":
            case "rain":
            case "nt_chancerain":
            case "nt_rain":
                return "rainy";
            case "chancetstorms":
            case "tstorms":
            case "nt_chancetstorms":
            case "nt_tstorms":
                return "thunderstorm";
            case "clear":
            case "sunny":
                return "sunny";
            case "nt_clear":
            case "nt_sunny":
                return "moon";
            case "cloudy":
            case "fog":
            case "hazy":
            case "nt_cloudy":
            case "nt_fog":
            case "nt_hazy":
                return "cloudy";
            case "mostlycloudy":
            case "mostlysunny":
            case "partlycloudy":
            case "partlysunny":
                return "partlysunny";
            case "nt_mostlycloudy":
            case "nt_mostlysunny":
            case "nt_partlycloudy":
            case "nt_partlysunny":
                return "cloudy-night";
            default:
                return "sunny";
        }
    }
	
	public function data() {
		return $this->_data;
	}
}
?>
