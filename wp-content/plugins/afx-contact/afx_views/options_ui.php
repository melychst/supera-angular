<?php
global $afx_options;
$afx_options = array(
    'afx_contact_from' => get_option('afx_contact_from'),
    'afx_contact_admin_to' => get_option('afx_contact_admin_to'),
    'afx_contact_bcc' => get_option('afx_contact_bcc'),
);

function the_option($option) {
    global $afx_options;
    if(isset($afx_options[$option])) echo $afx_options[$option];
}

function the_domain() {
    echo get_site_url()."/";
}

?>

<div class="wrap">  
    <h2>AFX Contact Options</h2>  
    <form method="post" action="options.php">  
        <?php settings_fields( 'afx_contact_fields' ); ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label for="afx_contact_from">From address:</label>
                    </th>
                    <td>
                        <input type='text' name="afx_contact_from" value="<?php the_option('afx_contact_from') ?>" />
                        <p class="description">Please enter what address your emails should be sent from. Be sure to whitelist this address to ensure it doesn't go into your SPAM.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="afx_contact_admin_to">Admin to address:</label>
                    </th>
                    <td>
                        <input type='text' name="afx_contact_admin_to" value="<?php the_option('afx_contact_admin_to') ?>" />
                        <p class="description">Please enter which address you would like to receive emails from your website.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="afx_contact_bcc">Bcc address:</label>
                    </th>
                    <td>
                        <input type='text' name="afx_contact_bcc" value="<?php the_option('afx_contact_bcc') ?>" />
                        <p class="description">To receive a copy of all emails enter your emails separated by a comma (,).</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><input type="submit" name="Submit" class="button button-primary" value="Save Changes" /></p>  
        <input type="hidden" name="action" value="update" />  
    </form>  
</div>