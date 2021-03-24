<?php ?>
<!-- Cookies desplegable bot -->
<div class="desplegable desplegable-lat desplegable-lat-bot" id="popup-cookies-bottom">
  <div class="desplegable-lat-bloque">
	 <div class="desplegable-lat-bloque-contain">
		<div class="section" id="">
		  <div class="fila ck_fila ck_mb-0 ck_pb-0 ck_mt-0 ck_pt-0">
			 <div class="col ck_d-f-jc-fs ck_mb-0 ck_pb-0">
				<p class="ck_titulo-popup ck_font-family"><?php _e("AVISO DE COOKIES", "esgalla"); ?></p>
			 </div>
		  </div>
		  <div class="fila ck_fila ck_mb-0 ck_pb-0 ck_mt-0 ck_pt-0">
			 <div class="col-md-8 ck_pb-0">
				<p class="ck_line-height ck_font-size-text ck_font-family ck_mb-0"><?php _e("Utilizamos cookies propias y de terceros con finalidades analíticas y para mostrarte publicidad relacionada con tus preferencias a partir de tus hábitos de navegación y tu perfil. Puedes configurar o rechazar las cookies haciendo click en 'Configuración de cookies'. También puedes aceptar todas las cookies pulsando el botón “Aceptar todas las cookies”. Para más información puedes visitar nuestra <a href='/politica-cookies/' target='_blank' style='text-decoration:underline;'>Política de cookies</a>", "esgalla"); ?></p>
			 </div>
			 <div class="col-md-4 ck_pt-0 ck_pb-0">
				<div class="col ck_w-100 ck_mb-0 ck_pb-0 ck_mt-0 text-center">
				  <button class="btn btn-cookies aceptar-cookies ck_font-family ck_w-50 mt-3 mt-md-0"><?php _e("ACEPTAR TODAS LAS COOKIES", "esgalla"); ?></button>
				</div>
				<div class="col ck_w-100 ck_mb-0 ck_pb-0 ck_pt-0-mob ck_mt-0 text-center">
				  <button class="btn btn-cookies configurar-cookies ck_font-family ck_w-50"><?php _e("CONFIGURAR COOKIES", "esgalla"); ?></button>
				</div>
			 </div>
		  </div>
		</div>
	 </div>
	 <!--desplegable-lat-bloque-contain-->
  </div>
  <a class="desplegable-fondo" data-obj="elem"></a>
</div>
<!-- Cookies desplegable bot -->

<!-- Lateral config -->
<div class="desplegable desplegable-lat desplegable-lat-der" id="config-cookies">
  <div class="desplegable-lat-bloque">
	 <div class="desplegable-lat-bloque-contain">
		<div class="section">
		  <div class="fila">
			 <div class="col text-center">
				<p class="ck_titulo-popup ck_font-family"><?php _e("Configurador de cookies", "esgalla"); ?></p>
			 </div>
			 <div class="col text-center">
				<p class="ck_text-center ck_line-height ck_font-size-text ck_font-family"><?php _e("Configura las cookies en función de tus preferencias.", "esgalla"); ?></p>
			 </div>


			 <!-- Accordions -->
			 <div class="col">
				<div class="accordion">
				  <div class="row">
					 <div class="col-8 ck_d-f-jc-fs ck_font-family">
						<div class="ck_w-100"><span class="ck_fs-14"><?php _e("Cookies técnicas", "esgalla"); ?></span></div> <a href="#" class="mas-info ck_font-family"><?php _e("Ver más", "esgalla"); ?></a>
					 </div>
					 <div class="col-4 ck_d-f-jc-fe text-right">
						<span style="font-size: 12px;font-style: italic;"><?php _e("Obligatorias", "esgalla"); ?></span>
					 </div>
				  </div>
				</div>
				<div class="panel">
				  <p class="ck_line-height ck_font-size-text ck_font-family"><?php _e("Estas cookies muestran la página adaptada a tu dispositivo o al idioma del navegador, entre otras configuraciones.", "esgalla"); ?></p>
				</div>
				<div class="accordion">
				  <div class="row">
					 <div class="col-8 ck_d-f-jc-fs ck_font-family">
						<div class="ck_w-100"><span class="ck_fs-14"><?php _e("Cookies de analítica", "esgalla"); ?></span></div> <a href="#" class="mas-info ck_font-family"><?php _e("Ver más", "esgalla"); ?></a>
					 </div>
					 <div class="col-4 ck_d-f-jc-fe">
						<label class="switch">
						  <input class="switch-input" type="checkbox" id="check-cookies-analitica">
						  <span class="switch-label" data-on="Acepto" data-off="Rechazo"></span>
						  <span class="switch-handle"></span>
						</label>
					 </div>
				  </div>
				</div>
				<div class="panel">
				  <p class="ck_line-height ck_font-size-text ck_font-family"><?php _e("Estas cookies recopilan información de tu navegación en la web - Podemos contabilizar el número de visitantes de la página o los contenidos.", "esgalla"); ?></p>
				</div>

				<div class="accordion">
				  <div class="row">
					 <div class="col-8 ck_d-f-jc-fs ck_font-family">
						<div class="ck_w-100"><span class="ck_fs-14"><?php _e("Cookies de publicidad", "esgalla"); ?></span></div> <a href="#" class="mas-info ck_font-family"><?php _e("Ver más", "esgalla"); ?></a>
					 </div>
					 <div class="col-4 ck_d-f-jc-fe">
						<label class="switch">
						  <input class="switch-input" type="checkbox" id="check-cookies-publicidad">
						  <span class="switch-label" data-on="Acepto" data-off="Rechazo"></span>
						  <span class="switch-handle"></span>
						</label>
					 </div>
				  </div>
				</div>
				<div class="panel">
				  <p class="ck_line-height ck_font-size-text ck_font-family"><?php _e("Estas cookies recogen información sobre los anuncios mostrados a cada usuario. - Adaptar la publicidad al tipo de dispositivo desde el que el usuario se está conectando.", "esgalla"); ?></p>
				</div>
			 </div>
			 <!-- Accordions -->
			 <div class="col ck_w-100 ck_mb-0 ck_pb-0 text-center mt-4">
				<button class="btn btn-cookies shadow-none aceptar-cookies ck_font-family"><?php _e("ACEPTAR TODAS", "esgalla"); ?></button>
			 </div>
			 <div class="col ck_w-100 ck_mb-0 ck_pb-0 ck_d-n hidden-guardar-cookies text-center mt-3">
				<button class="btn btn-cookies guardar-cookies ck_font-family"><?php _e("GUARDAR CONFIGURACIÓN", "esgalla"); ?></button>
			 </div>
			 <div class="col ck_w-100 ck_mb-0 ck_mt-0 ck_pt-0 ck_pb-0 ck_m-auto text-center">
				<button class="btn btn-cookies rechazar-cookies ck_font-family"><?php _e("RECHAZAR TODAS", "esgalla"); ?></button>
			 </div>
		  </div>
		</div>
		<a href="javascript:void(0)" class="desplegable-plegar btn-cerrar ck_cerrar" data-obj="#config-cookies"><span class="fas fa-times" aria-hidden="true"></span></a>
	 </div>
	 <!--desplegable-lat-bloque-contain-->
  </div>
  <a class="desplegable-fondo" data-obj="elem"></a>
</div>
<!-- Lateral config -->
