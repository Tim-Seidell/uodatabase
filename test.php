<?php require 'header.php' ?>
<div style = "padding-top: 100px"></div>
<div class = "container">
    <div class = "div_card">
        <select name = "item" class="dropdown" size = 6 style="width: 230px; height: 43px">
            <div class = "scrollable-menu">
                <option value="">- Select Item -</option>
                <?php dropdownOptions("list_of_uniform_items","item_name","item_table_name"); ?>
            </div>
        </select>

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Scrollable Menu <span class="caret"></span></button>
            <ul class="dropdown-menu scrollable-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
            </ul>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>