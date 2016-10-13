<?php
  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'afx_email_template_post_meta', 'afx_email_template_post_meta_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $type = get_post_meta( $post->ID, 'afx_email_template_type', true );
  $footer = get_post_meta( $post->ID, 'afx_email_footer', true );
?>
<p>
    <span>Template: <b><?php echo $type ?></b></span>
</p>
<p>
    <h2>Header</h2>
    <?php wp_editor($post->post_content,'content') ?>
    <h2>Footer</h2>
    <?php wp_editor( $footer, 'afx_email_footer') ?>
</p>