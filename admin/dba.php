<?php

$sadmin = true;
$title = "Admin Dashboard : Query Dashboard";
require_once "chunks/top.php";

?>
    <div class="container" style="margin-top: 20px">
        <form method="post" action="backend/q.php">
            <div class="row" style="margin-bottom: 22px;">
                <button type="reset" tabindex="3" class="btn waves-effect red left">Reset</button>
                <button type="submit" tabindex="2" class="btn waves-effect indigo right">Query</button>
            </div>
            <div class="input-field">
                <textarea tabindex="1"
                          name="query" placeholder="MySQL Query"
                          class="materialize-textarea"
                          id="query"><?= isset($_SESSION["Q"]) ? $_SESSION["Q"] : "" ?></textarea>
                <label for="query">MySQL Query</label>
            </div>

        </form>
        <?php if (isset($_SESSION["Q_DATA"])): ?>
            <div class="container" style="overflow-y: scroll">
                <table class="centered responsive-table highlight dataTable">
                    <thead>
                    <tr>
                        <?php foreach ($_SESSION["Q_DATA"][0] as $field_name => $val): ?>
                            <th><?= $field_name ?></th>
                        <?php endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($_SESSION["Q_DATA"] as $data): ?>
                        <tr>
                            <?php foreach ($data as $d => $v): ?>
                                <td><?= $v ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
<?php
if (isset($_SESSION["Q_DATA"]))
    unset($_SESSION["Q_DATA"]);
if (isset($_SESSION["Q"]))
    unset($_SESSION["Q"]);
require_once "chunks/bottom.php";
