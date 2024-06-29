<?php
include_once 'header.php'
?>

        

       
<div class="container g-0">
  <div class="column-1 ">
    <img class="centrarLgo"src="img/logoGrande.png" alt="Imagen">
    
    <p id="slogan" >Cada mate tiene una historia <br> <span id="sloganP2">¿Cual es la tuya?</span></p>

    
    <button type="button" class="btn " id="btnRegis"  type="submit"><a href="login/ingresar.php" class="linkBtn">REGISTRATE</a></button>
    <button type="button" class="btn " id="btnSesion" type="submit" ><a href="login/ingresar.php"  class="linkBtn">INICIAR SESION</a></button>

  </div>
  <div class="column-2">
    <div class="carousel">
     <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner position-relative align-items-center">
              <div class="carousel-item active">
              <img src="img/imperial.png" class="d-block " alt="..." width="400">
              <div class="overlay">
                  <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt fugiat nobis animi hic, ullam, id saepe quod cumque eveniet aut aliquid optio repellendus! Iusto, laudantium laboriosam eaque repellat labore mollitia!</h5>
              </div>
              </div>
              <div class="carousel-item ">
              <img src="img/torpedo.png" class="d-block " alt="..." width="400">
              <div class="overlay">
                  <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt fugiat nobis animi hic, ullam, id saepe quod cumque eveniet aut aliquid optio repellendus! Iusto, laudantium laboriosam eaque repellat labore mollitia!</h5>
              </div>
              </div>
              <div class="carousel-item" >
                  <img src="img/camionero.PNG" class="d-block" width="400" alt="...">
                  <div class="overlay">
                  <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt fugiat nobis animi hic, ullam, id saepe quod cumque eveniet aut aliquid optio repellendus! Iusto, laudantium laboriosam eaque repellat labore mollitia!</h5>
                  </div>
              </div>
              <div class="carousel-item" >
                  <img src="img/imperialPremium.PNG" class="d-block" width="400" alt="...">
                  <div class="overlay">
                  <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt fugiat nobis animi hic, ullam, id saepe quod cumque eveniet aut aliquid optio repellendus! Iusto, laudantium laboriosam eaque repellat labore mollitia!</h5>
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Anterior</span>
              </button>
              <button  class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Siguiente</span>
              </button>
          </div>
          </div>
    </div>
  </div>
</div>

<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
