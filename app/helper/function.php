<?php
function showError($errors,$nameInput)
{
    if($errors->has($nameInput))
    {
    echo '<div class="alert alert-danger" role="alert">';
    echo '<strong>'.$errors->first($nameInput).'</strong>';
    echo '</div>';
    }
 
}