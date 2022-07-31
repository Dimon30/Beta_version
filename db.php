<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
<script type="text/javascript" src="/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=BKCOGPBtEn1kJY2g9ok459fME_YrlEyE8_ehSIS5uPWZbiySkEPZAOiM96wR0J-X6gyQonQRMZesLdpka4vnoa-rba7cVvrfCr9SyRIU53p7nhag2avA1b9cMU99LVzZZAxFtyzjq97n5tWCdwH-qHgizfFCBcUrl-Qgq8o0xS8_Cf3Vg2_QygQCN0mH_00tEJ1f_yUnNL58RSDxxYIIfnJrRYLDr4ttm9a-dh5x98NT8RphWB2iDffLmraUAdTRszDHUjZ5kP_6Hqam8fzBnsHBHjOMEqx2SEqVEDFFJl539K6px27Fxwl2Zx1C_sC69SHLcUEKM-mEOz18SEqMTNM4ozNtKs-vv62_j0wy3biZgo69L-jnHzWShp5xwsIkOf8GcSZyjhl9PT6bSWhi81IBAPdXkqvcVXdcie12bvW90-c8C2JMdfMLxfHrRn1pSmxprHE4GKFGZzgEog9UmsbTP9LdRLwhPE_jiG4yw-V7MqfAA1cYVxryNtaryhEMTVZZVE6WwZTaE3S7UsBgDCXKGxIIkleZC3eXm9aYMykhfqkz9eT2-vSwms3fLDRKSkVj6RoC-bYI-XJc8lbP_IyWHagpkylgU7dQEej-5fJDiVezYNgGOAwirL-_rb6wwwFSo1A6HwArfERbDxl8GzQ6XUYIaeamJeHZghlX5zAsyEmQHr4A0eLAQIlXgFPs_wZzA744VUp2lYoqeZVvy4rSHEosT26GnV2og5fH6ntOvJ68aCytGuGdWq_mX7uFbHSyYMwO8BxNVImInDuGUnbIwWitIIRV1pRaybbjm_avc0IwTRsO6GsfggwWybH7-QHhoNmz41eMgSSzTDD42yjDkg8Y4ABCzqdOY3vkMPjrj5VSn-Jz38234mPOqJ9NRe9C2E6coTOzPAn9df0QMiVs22i0k3pOQafMbQ7E9UnOQLHhMrOnNp-T5tnci215Dn29lNAqjj9JwX7aOH2353dh2-VgP_ME4G9Migmc788" charset="UTF-8"></script></head>
<body>
  <?php
    include "func.php";

    /* Adding pupil to the end */

    // Form for adding
    if (isset($_POST['todo']) && $_POST['todo'] == 'add')
    {
        echo "<form action='db.php' method='post'>" .
            "<input type='text' name='Surname' value='Surname'>" .
            "<input type='text' name='Name' value='Name'>" .
            "<input type='date' name='Birthday' value='Birthday'>" .
            "<input type='int' name='Form' value='Form'>" .
            "<input type='text' name='FormDigit' value='FormDigit'>" .
            "<input type='text' name='Sex' value='Sex'>" .
            "<input type='submit' name='add' value='add'>" .
        "</form>";

        $k = 1;
        echo "<table border='1'>";
        foreach ($tmp = sql_req("select * from pupils") as $i)
        {

            echo "<tr>" .
                "<td>" . $k . "</td>" .
                "<td>" . "<input type='image' width='27' src='edit.png'> " .
                "</form></td>" .
                "<td>" . $i["Surname"] . "</td><td>" . $i["Name"] . "</td><td>" . $i["Birthday"] . "</td><td>" . $i["Form"] . "</td><td>" . $i["FormDigit"] . "</td>" .
                "<td><input type='image' width='27' src='del.png'>" .
                "</td></tr>";
            $k += 1;
        }
        echo "</table>";
    }
    // Request for add
    if (isset($_POST['add'])) {
        sql_req("insert into pupils values ('', '" . $_POST['Surname'] . "', '" . $_POST['Name'] . "', '" . $_POST['Birthday'] . "', '" . $_POST['Form'] . "', '" . $_POST['FormDigit'] . "', '" . $_POST['Sex'] . "')");
    }

    /* Delete pupil by id */
    if (isset($_POST['todo']) && $_POST['todo'] == 'del')
     {
         sql_req("delete from pupils where id=" . intval($_POST['id']));
     }


    /* Edit pupil by id */

    // Visualization of edition pupil
    if (isset($_POST['todo']) && $_POST['todo'] == 'edit')
    {
        $k = 1;
        echo "<table border='1'>";
        foreach ($tmp = sql_req("select * from pupils") as $i)
        {
            if ($k == $_POST['id'])
            {
                echo "<tr>" .
                    "<td>" . $k . "</td>" .
                    "<td>Editing...</td>" .
                   "<input type='text' name='Surname' value='". $i["Surname"] ."'></td>" .
                    "<form action='db.php' method='post'><td>" .
                    "<td>" . "<input type='text' name='Name' value='". $i["Name"] ."'>" .
                    "<input type='hidden' name='Id' value='". $i['id'] . "'>" . "</td>" .
                    "<td>" . "<input type='date' name='Birthday' value='". $i["Birthday"] ."'></td>" .
                    "<td>" . "<input type='int' name='Form' value='". $i["Form"] ."'></td>" .
                    "<td>" . "<input type='text' name='FormDigit' value='". $i["FormDigit"] ."'></td>" .
                    "<td>". "<input type='submit' name='edit' value='Send'> " . "</td>" .
                    "</form></tr>";

            }
            echo "<tr>" .
                "<td>" . $k . "</td>" .
                "<td><form action='db.php' method='post'>".
                "<input type='hidden' name='todo' value='edit'> " .
                "<input type='image' width='27' src='edit.png'> " .
                "</form></td>" .
                "<td>" . $i["Surname"] . "</td><td>" . $i["Name"] . "</td><td>" . $i["Birthday"] . "</td><td>" . $i["Form"] . "</td><td>" . $i["FormDigit"] . "</td>" .
                "<td><form action='db.php' method='post'>" .
                "<input type='hidden' name='todo' value='del'>" .
                "<input type='hidden' name='id' value='" . $i["id"] . "'>" .
                "<input type='image' width='27' src='del.png'>" .
                "</form></td></tr>";
            $k += 1;
        }
        echo "</table>";

    }
    // Request of edit
    if (isset($_POST['edit'])) {
        sql_req("update pupils set Surname = '" . $_POST['Surname'] .
                                "', Name = '" . $_POST['Name'] .
                                "', Birthday = '" . $_POST['Birthday'] .
                                "', Form = '" . $_POST['Form'] .
                                "', FormDigit = '" . $_POST['FormDigit'] .
                                "' where id = '" . $_POST['Id'] . "'");
    }


    /* Request for output all pupils */
    if (!isset($_POST["todo"]))
        $all = sql_req("select * from pupils", 1);
    else
        $all = sql_req("select * from pupils");




  if (!(isset($_POST['todo']) && ($_POST['todo'] == 'edit' || $_POST['todo'] == 'add')))
  {
      echo "<table border='1'>";

      $k = 1;
      foreach ($all as $i) {
          echo "<tr>" .
              "<td>" . $k . "</td>" .
              "<td><form action='db.php' method='post'>" .
              "<input type='hidden' name='todo' value='edit'> " .
              "<input type='hidden' name='id' value='" . $k . "'>" .
              "<input type='image' width='27' src='edit.png'> " .
              "</form></td>" .
              "<td>" . $i["Surname"] . "</td><td>" . $i["Name"] . "</td><td>" . $i["Birthday"] . "</td><td>" . $i["Form"] . "-" . $i["FormDigit"] . "</td>" .
              "<td><form action='db.php' method='post'>" .
              "<input type='hidden' name='todo' value='del'>" .
              "<input type='hidden' name='id' value='" . $i["id"] . "'>" .
              "<input type='image' width='27' src='del.png'>" .
              "</form></td></tr>";
          $k += 1;
      }
      echo "<form action='db.php' method='post'>" .
           "<input type='submit' name='todo' value='add'>" .
           "</form>";
  }

  echo "<pre>";
  print_r($GLOBALS);
  echo "</pre>";

  ?>
</body>
</html>