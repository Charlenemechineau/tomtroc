<?php


class Utils {

    //Fonction qui permet de convertir une date au format français//
    public static function convertDateToFrenchFormat(DateTime $date) : string
    {
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('EEEE d MMMM Y');
        return $dateFormatter->format($date);
    }

    //Fonction qui permet de rediriger vers une autre pages//
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    //Fonction qui permet d'afficher une boite de confirmation avant une action//
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }

     // Cette fonction sert à afficher du texte proprement sur la page
    // Elle enlève les caractères dangereux et met chaque ligne dans un paragraphe <p>
    public static function format(string $string) : string
    {
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        $lines = explode("\n", $finalString);

        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }
        
        return $finalString;
    }
    // Cette fonction récupère une information envoyée par un formulaire ou un lien
    // Si l'information n'existe pas, elle renvoie une valeur par défaut
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

}