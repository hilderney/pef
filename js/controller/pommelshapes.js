$(document).ready(function() {
    m = {};
    m.func = 'load';
    currentPage = 1;
    lastPage = 1;
    firstItem = 0;
    lastItem = 0;
    itensPerPage = 10;
    fullTable = {};
    loadPommelShapes(m);

    $('#btn_createPommelShape').on('click', function() {
        m.nome = $('#txt_pommelShapeName').val();
        m.desc = $('#txt_pommelShapeDesc').val();
        m.weight = $('#range_pommelShapeWeight').val();
        m.func = 'create';
        createNewPommelShape(m);
    });

    $(document).on('click','table tr td button', function(e) {
        if (e.target.dataset['func'] === 'edit') {
            m.id = e.target.dataset['value'];
            m.func = 'loadOne';
            loadPommelShapes(m);
        }
        else if (e.target.dataset['func'] === 'delete') {
            m = {};
            m.id = e.target.dataset['value'];
            m.func = 'delete';
            deletePommelShape(m);
        }
    });

    $('#btn_editPommelShape').on('click', function() {
        m.nome = $('#txt_pommelShapeName_edit').val();
        m.desc = $('#txt_pommelShapeDesc_edit').val();
        m.weight = $('#range_pommelShapeWeight_edit').val();
        m.func = 'edit';
        createNewPommelShape(m);        
    });

    $(document).on('click','.expandable-on-click', function(e) {
        var content = '';
        m.id = e.target.dataset['value'];
        m.func = 'loadItem';
        m.field = e.target.dataset['field'];
        loadPommelShapes(m);
    });

    function createNewPommelShape(m) {
        $.ajax({ //Função AJAX
            url: "app/pommelShape.php" //Arquivo php
            , type: "post" //Método de envio
            , data: { 
                'id' : m.id
                , 'nome' : m.nome
                , 'descricao' : m.desc
                , 'fatorPeso' : m.weight
                , 'func' : m.func
            } //Dados
            , success: function(d) { //Sucesso no AJAX
                console.log(d);
                if (isJson(d) && d != '[]') {
                    m = { func:'load' };
                    loadPommelShapes(m);
                    if (JSON.parse(d) > 0) {
                        console.log(JSON.parse(d) + ' linha(s) afetada(s)');
                    }
                    else {
                        console.log(JSON.parse(d) + ' linha(s) afetada(s) - erro ao inserir');
                    }
                    $('#nav-tab-listar').click();
                } 
                else {
                    console.log(d);
                    //sessionStorage.clear();
                    console.log('Verifique login ou senha');
                }
            }
            , error: function(e) {
                //sessionStorage.clear();
                console.log(e.responseText);
            }
        });
        return false;
    }

    function loadPommelShapes(m,p=null) {
        $.ajax({ //Função AJAX
            url: "app/pommelshape.php" //Arquivo php
            , type: "post" //Método de envio
            , data: {
                'id' : m.id
                ,'field' : m.field
                ,'func' : m.func
            } //Dados
            , success: function(d) { //Sucesso no AJAX
                if (isJson(d) && d != '[]') {
                    json = JSON.parse(d);                   
                    if (m.func === 'load') {
                        fullTable = json;
                        p != null ? currentPage = p : '';
                        createNewTable( fullTable, currentPage, $('#table-container') );
                    }
                    else if (m.func === 'loadOne') {
                        $('#nav-tab-editar').click();
                        $('#txt_pommelShapeName_edit').val(json.name);
                        $('#txt_pommelShapeDesc_edit').val(json.description);
                        $('#range_pommelShapeWeight_edit').val(json.weight);
                        $('#range_pommelShapeWeight_edit').change();
                    }
                    else if (m.func === 'loadItem') {
                        createModal(json, m.field);
                    }
                    else {
                        console.log('erro não informado');
                    }
                }
                else {
                    console.log(d);
                    //sessionStorage.clear();
                    console.log('Não há dados na Tabela pommelshapes');
                    debugger;
                }
            }
            , error: function(e) {
                //sessionStorage.clear();
                console.log(e.responseText);
                debugger;
            }
        });
        return false;
    }

    function deletePommelShapes(m) {
        $.ajax({ //Função AJAX
            url: "app/pommelShape.php" //Arquivo php
            , type: "post" //Método de envio
            , data: { 
                'id' : m.id
                , 'func' : m.func
            } //Dados
            , success: function(d) { //Sucesso no AJAX
                console.log(d);
                if (isJson(d) && d != '[]') {
                    m = { func:'load' };
                    loadPommelShapes(m);
                    if (JSON.parse(d) > 0) {
                        console.log(JSON.parse(d) + ' linha(s) afetada(s)');
                    }
                    else {
                        console.log(JSON.parse(d) + ' linha(s) afetada(s) - erro ao inserir');
                    }
                    $('#nav-tab-listar').click();
                } 
                else {
                    console.log(d);
                    //sessionStorage.clear();
                    console.log('Verifique login ou senha');
                }
            }
            , error: function(e) {
                //sessionStorage.clear();
                console.log(e.responseText);
            }
        });
        return false;
    }

    function log(a){
        console.log(a);
    }

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    function createNewTable(d,p,t) {
        t.html('');
        table = $('<table class="table table-striped"></table>');
        thead = $('<thead></thead>');
        tbody = $('<tbody></tbody>');

        console.log(Object.keys(d[0]));

        var th = Object.keys(d[0]);
        var tr = $('<tr></tr>');
        
        for(i of th){
            tr.append($('<th>' + i + '</th>'));
        }

        tr.append($('<th> actions </th>'));
        thead.append(tr);
        table.append(thead);

        currentPage = p;
        lastPage = Math.ceil(d.length / itensPerPage);

        currPageElem = $('<li id="currPage" class="page-item" data-value="' + p + '"> <a class="page-link" href="#"> ' + p + ' </a> </li>');
        prevPageElem = $('<li id="prevPage" class="page-item" data-value="' + (p-1) + '"> <a class="page-link" href="#"> <i class="material-icons"> navigate_before </i> </a> </li>');
        nextPageElem = $('<li id="nextPage" class="page-item" data-value="' + (p+1) + '"> <a class="page-link" href="#"> <i class="material-icons"> navigate_next </i> </a> </li>');
        

        if (currentPage <= 1) { // Caso de pagina ser <= que a primeira
            currentPage = 1;
            prevPageElem.html('<a class="page-link" href="#" tabindex="-1"> <i class="material-icons"> navigate_before </i> </a>');
            prevPageElem.addClass('disabled');
            prevPageElem.attr('data-value', '1');
        }
        else if (currentPage >= lastPage) { // Caso de pagina ser >= que a ultima
            currentPage = lastPage;
            nextPageElem.html('<a class="page-link" href="#" tabindex="-1"> <i class="material-icons"> navigate_next </i> </a>');
            nextPageElem.addClass('disabled');
            nextPageElem.attr('data-value', lastPage);
        }
        firstItem = ( currentPage - 1 ) * itensPerPage; // primeiro item da pagina
        lastItem = ( currentPage * itensPerPage) - 1; // ultimo item da pagina
        lastItem >= (d.length -1) ? lastItem = (d.length -1) : ''; // ulimo item não pode ser maior que d.length

        for (var r = firstItem; r <= lastItem; r++) {
            tr = $('<tr></tr>');
            for(i of th) {
                var cont;
                d[r][i] === null ? d[r][i] = 'null' : '';
                if (d[r][i].length > 30) {
                    cont = d[r][i].substring(33, 0).trim().concat('...');
                    tr.append($('<td id="expand-data-row-' + d[r]['id'] + '-col-' + i + '" class="expandable-on-click" data-value="' + d[r]['id'] + '" data-func="loadItem" data-field="' + i + '">' + cont + '</td>'));
                }
                else {
                    cont = d[r][i];
                    tr.append($('<td>' + cont + '</td>'));
                }
            }
            btnEdit = $('<i class="material-icons" style="padding: 0 2px;"> <button type="button" id="item-edit-' + d[r]['id'] + '" data-value="' + d[r]['id'] + '" data-func="edit" class="btn btn-warning"> edit  </button> </i>');
            btnDelete = $('<i class="material-icons" style="padding: 0 2px;"> <button type="button" id="item-delete-' + d[r]['id'] + '" data-value="' + d[r]['id'] + '" data-func="delete" class="btn btn-danger"> delete_forever </button> </i>');
            td = $('<td> </td>');
            td.append(btnEdit);
            td.append(btnDelete);
            tr.append(td);
            tbody.append(tr);
        }

        table.append(tbody);

        navPag = $('<nav aria-label="Page navigation example"> <ul class="pagination justify-content-end"> </ul> </nav>');
        navPag.children().append(prevPageElem);
        navPag.children().append(currPageElem);
        navPag.children().append(nextPageElem);

        (d.length / itensPerPage) < 1 ? '' : t.append(navPag);
        t.append(table);

        $('#prevPage').on('click', function(){
            if (currPage.dataset['value'] === '1') {
                console.log(currPage.dataset['value'] + ' = ' + p);
            }
            else{
                console.log(currPage.dataset['value'] + ' != 1');
                currentPage = p - 1;
                loadPommelShapes(m, currentPage);
            }
        });
        $('#currPage').on('click', function(){
            console.log('clicou atual');
        });
        $('#nextPage').on('click', function(){
            if (currPage.dataset['value'] === String(lastPage)) {
                console.log(currPage.dataset['value'] + ' = ' + String(lastPage));
            }
            else {
                console.log(currPage.dataset['value'] + ' != ' + String(lastPage));
                currentPage = p + 1;
                loadPommelShapes(m, currentPage);
            }
        });
    }

    function createModal(d, field) {
        modal = $('<div id="modal-' + field + '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel-'+ field + '" aria-hidden="true"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title" id="largeModalLabel-'+ field + '">' + field + '</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button> </div> <div class="modal-body"> <small>' + d[0] + '</small> </div> </div> </div> </div>');    
        $('#modalContainer').append(modal);
        $('#modal-' + field).modal('show');
        $('#modalContainer').on('hidden.bs.modal', '#modal-' + field, function (e) {
            $('#modal-' + field).modal('dispose');
            $('#modalContainer').html('');
        });
    }


});