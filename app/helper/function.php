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


function showCategory($mang,$parent,$tab)
{
    foreach ($mang as $value) {
        if($value['parent']==$parent)
        {
           echo '
           <div class="item-menu"><span>'.$tab.$value['name'].'</span>
                <div class="category-fix">
                    <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                    <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>
                </div>
            </div>
           ';  
           showCategory($mang,$value['id'],$tab.'--|');
        }
    }
}