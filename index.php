<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-oop-3</title>
</head>
<style>
    * {
        background-color: blue;
        color: white;
    }
</style>

<body>
    <?php

    class Stipendio
    {
        public $mensile;
        public $tredicesima;
        public $quattordicesima;

        public function __construct($mensile, $tredicesima, $quattordicesima)
        {
            $this->setMensile($mensile);
            $this->setTredicesima($tredicesima);
            $this->setQuattordicesima($quattordicesima);
        }
        public function getMensile()
        {

            return $this->mensile;
        }
        public function setMensile($mensile)
        {

            $this->mensile = $mensile;
        }
        public function getTredicesima()
        {

            return $this->tredicesima;
        }
        public function setTredicesima($tredicesima)
        {

            $this->tredicesima = $tredicesima;
        }
        public function getQuattordicesima()
        {

            return $this->quattordicesima;
        }
        public function setQuattordicesima($quattordicesima)
        {

            $this->quattordicesima = $quattordicesima;
        }
        public function getAnnualSalary()
        {
            $mensile = $this->getMensile();
            return $mensile * 12
                + ($this->getTredicesima() ? $mensile : 0)
                + ($this->getQuattordicesima() ? $mensile : 0);
        }
        public function getHtmlStipendio()
        {
            return "Mensile: " . $this->getMensile() . "<br>"
                . "Tredicesima: " . ($this->getTredicesima() ? "si'" : "no") . "<br>"
                . "Quattordicesima: " . ($this->getQuattordicesima() ? "si'" : "no") . "<br>"
                . "---------------<br>"
                . "Annuale: " . $this->getAnnualSalary();
        }
    }

    class Persona
    {
        private $nome;
        private $cognome;
        private $dataNascita;
        private $luogoNascita;
        private $cf;

        public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $cf)
        {
            $this->setNome($nome);
            $this->setCognome($cognome);
            $this->setDataNascita($dataNascita);
            $this->setLuogoNascita($luogoNascita);
            $this->setCf($cf);
        }

        public function getNome()
        {

            return $this->nome;
        }
        public function setNome($nome)
        {

            $this->nome = $nome;
        }
        public function getCognome()
        {

            return $this->cognome;
        }
        public function setCognome($cognome)
        {

            $this->cognome = $cognome;
        }
        public function getDataNascita()
        {

            return $this->dataNascita;
        }
        public function setDataNascita($dataNascita)
        {

            $this->dataNascita = $dataNascita;
        }
        public function getLuogoNascita()
        {

            return $this->luogoNascita;
        }
        public function setLuogoNascita($luogoNascita)
        {

            $this->luogoNascita = $luogoNascita;
        }
        public function getCf()
        {

            return $this->cf;
        }
        public function setCf($cf)
        {

            $this->cf = $cf;
        }


        public function getHtmlPersona()
        {
            return
                "<ul>
                <li>Nome: " . $this->getNome() . "</li>" .
                "<li> Cognome: " . $this->getCognome() . "</li>" .
                "<li>Data di Nascita: " . $this->getDataNascita() . "</li>" .
                "<li>Luogo di Nascita: " . $this->getLuogoNascita() . "</li>" .
                "<li>Codice Fiscale: " . $this->getCf() . "</li>" .
                "</ul>";
        }
    }

    class Impiegato extends Persona
    {
        private Stipendio $stipendio;
        private $dataAssunzione;

        public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $cf, Stipendio $stipendio, $dataAssunzione)
        {
            parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $cf);
            $this->setStipendio($stipendio);
            $this->setDataAssunzione($dataAssunzione);
        }

        public function getStipendio()
        {

            return $this->stipendio;
        }
        public function setStipendio($stipendio)
        {

            $this->stipendio = $stipendio;
        }
        public function getDataAssunzione()
        {

            return $this->dataAssunzione;
        }
        public function setDataAssunzione($dataAssunzione)
        {

            $this->dataAssunzione = $dataAssunzione;
        }

        public function getAnnualSalary()
        {

            return $this->getStipendio()->getAnnualSalary();
        }

        public function getHtmlImpiegato()
        {
            return parent::getHtmlPersona() .
                "<ul>
                <li>Stipendio Annuale: " . $this->getAnnualSalary() . " &euro;</li>" .
                "<li>Data di assunzione: " . $this->getDataAssunzione() . "</li>" .
                "</ul>";
        }
    }

    class Capo extends Persona
    {
        private $dividendo;
        private $bonus;

        public function __construct($nome, $cognome, $dataNascita, $luogoNascita, $cf, $dividendo, $bonus)
        {
            parent::__construct($nome, $cognome, $dataNascita, $luogoNascita, $cf);
            $this->setDividendo($dividendo);
            $this->setBonus($bonus);
        }

        public function getDividendo()
        {

            return $this->dividendo;
        }
        public function setDividendo($dividendo)
        {

            $this->dividendo = $dividendo;
        }
        public function getBonus()
        {

            return $this->bonus;
        }
        public function setBonus($bonus)
        {

            $this->bonus = $bonus;
        }
        public function getAnnualSalary()
        {

            return $this->getDividendo() * 12 + $this->getBonus();
        }



        public function getHtmlCapo()
        {
            return parent::getHtmlPersona() .
                "<ul>
                <li>Dividendo: " . $this->getDividendo() . " &euro;</li>" .
                "<li>Bonus: " . $this->getBonus() . " &euro;</li>" .
                "</ul>";
        }
    }


    echo "IMPIEGATO-1-:";
    $impiegato = new Impiegato("Lorenzo", "Verdi", "1999-06-09", "Milano", "LORVRD95U8EOKL5", new Stipendio("1800", true, true), "2023-01-01");
    echo $impiegato->getHtmlImpiegato();


    echo "IMPIEGATO-2-:";
    $impiegato = new Impiegato("Federica", "Bianchi", "1998-12-10", "Napoli", "MDRVRD95UASDFAW", new Stipendio("1500", true, true), "2023-01-01");
    echo $impiegato->getHtmlImpiegato();


    echo "CAPO:";
    $capo1 = new Capo("Mario", "Rossi", "1978-12-10", "Roma", "JDIOWE390E23732", "2809", "6000");
    echo $capo1->getHtmlCapo();
    ?>

</body>

</html>