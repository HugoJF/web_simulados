<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Question categories</h4>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <form data-baseurl="<?php echo base_url('questions/search'); ?>" data-mode="add" id="categorySelectorForm">
                <div id="selectPlaceholder">
                    <select data-level=0 id="categorySelector" class="form-control">
                        <option disabled selected>Selecione uma categoria...</option>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button id="categorySelectorAddButton" type="button" class="btn btn-primary">Adicionar</button>
                <button id="categorySelectorSubmitButton" type="submit" class="btn btn-success">Buscar</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="container">
                <div class="input-group spinner">
                    <div class="btn-group">
                        <p style="line-height:34px;vertical-align:middle;display:table-cell;height:34px" class="pull-left">Questions per category</p>
                        <input id="categorySelectorNumPerCategoryValue" style="width:100px" type="text" class="form-control" value="5">
                        <button class="btn btn-default"><span class="glyphicon glyphicon-chevron-down"></span></button>
                        <button class="btn btn-default"><span class="glyphicon glyphicon-chevron-up"></span></button>
                    </div>
                </div>
            </div>
            <div id="categorySelectorList">
                <ul>

                </ul>
            </div>
        </div>
    </div>
</div>