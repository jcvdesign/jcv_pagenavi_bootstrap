<div class="wrap">
	  <h1>jcv.design</h1>
      <h3>Pagenavi & Bootstrap - Configurações</h3>

	  <form method="post" action="options.php">
			<?php settings_fields( 'jcv-pagenavi-bootstrap-options' ); ?>
			<?php do_settings_sections( 'jcv-pagenavi-bootstrap-options' ); ?>
			<table class="form-table">
				  <tr valign="top">
						<th scope="row">Estilos css adicionais</th>
						<td><input type="text" class="regular-text code" name="<?php echo OPREFIX; ?>custom_class" value="<?php echo esc_attr( get_option(OPREFIX.'custom_class') ); ?>" /></td>
				  </tr>
				  <tr valign="top">
						<th scope="row">Alinhamento</th>
						<td><?php $valuealign = esc_attr( get_option(OPREFIX.'align')); ?>
							  <select class="regular-text code" name="<?php echo OPREFIX; ?>align">
									<?php
									$options = [
												'' => esc_html__( 'Esquerda', 'jcv-pagenavi-bootstrap' ),
												'justify-content-center' => esc_html__( 'Centralizado', 'jcv-pagenavi-bootstrap' ),
												'justify-content-end' => esc_html__( 'Direita', 'jcv-pagenavi-bootstrap' ),
											   ];
									foreach ( $options as $id => $label ) { ?>
										  <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $valuealign, $id, true ); ?>>
												<?php echo strip_tags( $label ); ?>
										  </option>
									<?php } ?>
							  </select>
							  
				  </tr>
				  <tr valign="top">
						<th scope="row">Tamanho</th>
						<td><?php $valuesize = esc_attr( get_option(OPREFIX.'size')); ?>
							  <select class="regular-text code" name="<?php echo OPREFIX; ?>size">
									<?php
									$options = [
									  '' => esc_html__( 'Normal', 'jcv-pagenavi-bootstrap' ),
									  'pagination-sm' => esc_html__( 'Pequeno', 'jcv-pagenavi-bootstrap' ),
									  'pagination-lg' => esc_html__( 'Grande', 'jcv-pagenavi-bootstrap' ),
									];
									foreach ( $options as $id => $label ) { ?>
										  <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $valuesize, $id, true ); ?>>
												<?php echo strip_tags( $label ); ?>
										  </option>
									<?php } ?>
							  </select>
						</td>
				  </tr>
			</table>
			
			<?php submit_button(); ?>
	  
	  </form>
</div>