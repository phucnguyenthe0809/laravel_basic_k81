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


function getCategory($mang,$parent,$tab)
{
    foreach ($mang as $value) {
        if($value['parent']==$parent)
        {
           echo '<option value="'.$value['id'].'">'.$tab.$value['name'].'</option>';  
           getCategory($mang,$value['id'],$tab.'--|');
        }
    }
}