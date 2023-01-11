<?php
    $empfaenger = "christian_steffen@outlook.com";
    if(isset($_REQUEST["absenden"])){
        if(empty($_REQUEST["name"]) || empty($_REQUEST["email"]) || empty($_REQUEST["vorname"]) || empty($_REQUEST["ortschaft"]) || empty($_REQUEST["postleitzahl"]) || empty($_REQUEST["strasse"])){
            $error = "Bitte füllen Sie alle Felder aus";
        }
        else{
            $mailbetreff = "Sie haben eine Anfrage über ihr Kontaktformular erhalten:\n";

            $mailnachricht = "Neue Kontaktanfrage von ".$_REQUEST["name"].$_REQUEST["vorname"]."\n".""."\n".
                      "Name: ".$_REQUEST["name"]."\n".
                      "Vorname: ".$_REQUEST["vorname"]."\n".
                      "Ortschaft: ".$_REQUEST["ortschaft"]."\n".
                      "Strasse-Nr: ".$_REQUEST["strasse"]."\n".
                      "E-Mail: ".$_REQUEST["email"]."\n".
                      "tel: ".$_REQUEST["telefonnumer"]."\n".
                      "Datum: ".date("d.m.Y H:i")."\n".
                      "\n\n".$_REQUEST["text"]."\n";
            if(mail($empfaenger, $mailbetreff, $mailnachricht))
            {
                $success = file_get_contents('C:\xampp\htdocs\php\pages\danke.php');
            }
            else{
                $error = "Beim Versenden Ihrer Anfrage ist ein Fehler aufgetreten! Versuchen Sie es bitte später nocheinmal";
            }
        }
    }
?>
<!DOCTYPE html>

<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Kontaktformular</title>
    <style media="screen">
    .body   {
      background-color: DeepSkyBlue;
      max-width:420px;
      margin:50px auto;
    }

    .mitte {
      max-width:420px;
      margin:50px auto;
    }

    .weiss {
    background-color: white

    }


    .eingabe {
      color:black;
      font-weight:500;
      font-size: 18px;
      border-radius: 5px;
      line-height: 22px;
      background-color: transparent;
      border:2px solid DarkBlue;
      padding: 13px;
      margin-bottom: 15px;
      width:100%;
      box-sizing: border-box;
      outline:0;
    }

    .danke {
      color:black;
      font-weight:500;
      font-size: 18px;
      border-radius: 5px;
      line-height: 22px;
      background-color: white;
      border:2px solid DarkBlue;
      padding: 13px;
      margin-bottom: 150px;
      margin-top: 300px;
      width:100%;
      box-sizing: border-box;
      outline:0;
    }

    .mitte2 {
      margin-left: 65px;
    }

    .text {
    font-size: 50px;

    }

    .nachricht {
      height: 200px;
      line-height: 200%;
      resize:vertical;
    }

    .absenden {
      width: 100%;
      background:DarkBlue;
      border-radius:5px;
      border:0;
      cursor:pointer;
      color:white;
      font-size:24px;
      padding-top:10px;
      padding-bottom:10px;
      margin-top:-4px;
      font-weight:700;
    }

    </style>
  </head>

  <!--Body mit Hintergrundfarbe-->
  <body class="body">

    <!--Kontaktformular-->
    <h1>Kontaktformular</h1>
<!--Variante 1-->
<!--https://form.taxi/s/9a1rskc9-->
<!--https://www.onlex.de/_formmailer.php?username=AirPlays" enctype="application/x-www-form-urlencoded-->

<!--Variante 2-->
<!--mailto:christian_steffen@outlook.com-->

<!--Variante 3 (php server und mailserver benötigt)-->
<!--C:\xampp\htdocs\php\php\new.php-->

    <section id="kontaktformular" class="mitte">
      <?php if(isset($success)){
          echo "<p>".$success."</p>";
      }
      else { ?>
      <form id="kontaktformular" action=""  method="POST" class="weiss">
        <fieldset>
          <label>
            Name *
            <input id="name" type="text" name="name" required class="eingabe">
          </label>

          <label>
            Vorname *
            <input id="vorname" type="text" name="vorname" required class="eingabe" >
          </label>

          <label>
            Strasse-Nr *
            <input id="strasse" type="text" name="strasse" required class="eingabe" >
          </label>

          <label>
            Postleitzahl *
            <input id="postleitzahl" type="text" name="postleitzahl" required class="eingabe" >
          </label>

          <label>
            Ortschaft *
            <input id="ortschaft" type="text" name="ortschaft" required class="eingabe" >
          </label>

          <label>
            Telefonnummer
            <input id="telefonnumer" type="tel" name="telefonnumer" required class="eingabe">
          </label>

          <label>
            E-Mail Adresse *
            <input id="email" type="email" name="email" required class="eingabe" >
          </label>

          <article>
            <label>
              Nachricht
              <textarea id="text" name="text" class="eingabe"></textarea class="nachricht">
            </label>
          </article>

        <p>*Pflichtfeld</p>

        </fieldset>
        <label></label>
        <button id="absenden" name="absenden" type="submit" class="absenden" onsubmit="validateForm()">Absenden</button>
      </form>
    </section>
    <script>
        function validateForm(){
            var form = document.getElementById("kontaktformular");
            return form.checkValidity();
        }
    </script>
    <?php
    }
    if(isset($error)){
        echo '<p>'.$error.'<p>';
    } ?>

  </body>

  <!--Fusszeile-->
  <footer>

    <p>&copy; Christian Steffen</p>


  </footer>
</html>
