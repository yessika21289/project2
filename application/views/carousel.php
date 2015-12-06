<?php

  $berita = $this->ypki->getLastBerita(5,NULL,$instansi);
  $jumlah = sizeof($berita);
  $prefix = "";
    if($instansi != "ypki") $prefix = $instansi."/";
?>

<div id="carousel-generic-example" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
      for ($i=0; $i<$jumlah; $i++)
      {
        if ($i == 0)
          echo "<li data-target='#carousel-generic-example' data-slide-to='".$i."' class='active'></li>";
        else
          echo "<li data-target='#carousel-generic-example' data-slide-to='".$i."'></li>";
      }
    ?>
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php
      $count = 0;
      foreach ($berita as $key => $value)
      {
        if($count == 0)
          echo "<div class='item active'>";
        else
          echo "<div class='item'>";
        $date = substr($value->created,0,4)."/".substr($value->created,5,2)."/".substr($value->created,8,2);
        $link = base_url().$prefix."berita/baca/".$date."/".urlencode($value->judul);

        $tipe = $this->ypki->getTipeGambar($value->gambar);
        if($tipe == "foto")
          echo "<a href='".$link."'><img src='".base_url()."asset/berita/".$value->gambar."' class='carousel-img' alt='".$value->judul."'/></a>";
        else
          echo "<a href='".$link."'><img src='".$value->gambar."' class='carousel-img' alt='".$value->judul."'/></a>";
        echo "<div class='carousel-caption'>";
        echo "<a href='".$link."'><h3>".$value->judul."</h3></a>";
        echo "<a href='".$link."'>read more...</a>";
        echo "</div></div>";
        $count++;
      }
    ?>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-generic-example" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-generic-example" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->