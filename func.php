<?php

  /* FUNCTION NAME: sql_req
   * ARGUMENTS: query, first_start
   * PURPOSE: Get array of rows table taking into account query
   * RETURN: Array
   */
  function sql_req( $query )
  {
    $link =  mysqli_connect("localhost", "root", "") or die('Error connecting to MySQL server: ' . mysqli_error());
    $db_name = "beta_version";

    // select database
    mysqli_select_db($link, $db_name);

    $res = mysqli_query($link, $query) or die(mysqli_error($link));

    if ($res === true)
      $a = [];
    else
    {
      $a = [];
      while ($row = mysqli_fetch_array($res))
        $a[] = $row;
    }
  
    mysqli_close($link);

    return $a;
  } /* End of function 'sql_req' */


  /* FUNCTION NAME: reqs_from_file
   * ARGUMENTS: filename
   * PURPOSE: Get array of queries from .sql file
   * RETURN: Array
   */
  function reqs_from_file( $filename )
  {
    $reqs = [];
    $req = '';

    $f = fopen($filename, "r") or die("Can't open file<br>");

    while (!feof($f))
    {
      if (($tmp = fgetc($f)) == ';')
      {
        $req .= $tmp;
        $reqs[] = $req;
        $req = '';
        continue;
      }
      $req .= $tmp;
    }

    if ($req != '')
      $reqs[] = $req;

    fclose($f);
    /*
    for ($i = 0; $i < count($reqs); $i++)
      echo $reqs[$i] . "<br>";
    */
    return $reqs;
  } /* End of function 'reqs_from_file' */
?>