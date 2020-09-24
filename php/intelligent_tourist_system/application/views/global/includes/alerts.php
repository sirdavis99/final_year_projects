<?php
if (isset($alert)):
    $form   = isset($form) ? $form: '';
    $target = implode(",", is_array($alert->field) ? $alert->field : ['']);
    echo '
      <!-- alert box starts -->
      
      <div class="alert alert-timeout alert-dismissible alert-' . $alert->cat . '" role="alert" manager-form="' . $form . '" manager-target="' . $target . '">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="text-sm">
          <b>Information</b>
          <p>' . $alert->msg . '</p>
        </div>
      </div>

      <!-- alert box ends -->
      ';
endif;
