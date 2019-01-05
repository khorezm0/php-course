<?php
function renderBottom()
{
?>

<footer>
    <div class="col d-md-none flex-end-align">
        <? if(!isLogined()){ ?>
            <a href="login.php" class="col-sm btn btn-link d-md-block d-lg-block">
                Войти
            </a>
            <a href="login.php?reg" class="col-sm btn btn-link d-md-block d-lg-block">
                Регистрация
            </a>
        <? } else{ ?>
            <a href="login.php?logout" class="col-sm btn btn-link d-md-block d-lg-block">
                Выйти
            </a>
        <? } ?>
    </div>
</footer>

<?
}
?>