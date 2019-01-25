$(document).ready(function() {
    m = {};
    m.func = 'load';
    loadParts(m);

    $('#btn_createPart').on('click', function() {
        m.nome = $('#txt_partName').val();
        m.desc = $('#txt_partDesc').val();
        m.weight = $('#range_partWeight').val();
        m.func = 'create';
        createNewPart(m);
    });

    $(document).on('click','table tr td button', function(e) {
        if (e.target.dataset['func'] === 'edit') {
            m.id = e.target.dataset['value'];
            m.func = 'loadOne';
            loadParts(m);
        }
        else if (e.target.dataset['func'] === 'delete') {
            m = {};
            m.id = e.target.dataset['value'];
            m.func = 'delete';
            deletePart(m);
        }
    });

    $('#btn_editPart').on('click', function() {
        m.nome = $('#txt_partName_edit').val();
        m.desc = $('#txt_partDesc_edit').val();
        m.weight = $('#range_partWeight_edit').val();
        m.func = 'edit';
        createNewPart(m);        
    });

    $(document).on('click','.expandable-on-click', function(e) {
        var content = '';
        m.id = e.target.dataset['value'];
        m.func = 'loadItem';
        m.field = e.target.dataset['field'];
        loadParts(m);
    });

    function createNewPart(m) {
        $.ajax({ //Função AJAX
            url: "app/part.php" //Arquivo php
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
                    loadParts(m);
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

    function loadParts(m) {
        $.ajax({ //Função AJAX
            url: "app/part.php" //Arquivo php
            , type: "post" //Método de envio
            , data: {
                'id' : m.id
                ,'field' : m.field
                ,'func' : m.func
            } //Dados
            , success: function(d) { //Sucesso no AJAX
                if (isJson(d) && d != '[]') {
                    json = JSON.parse(d);                   
                    if (m.func === 'load')
                        createNewTable( json, $('#table-container') );
                    else if (m.func === 'loadOne') {
                        $('#nav-tab-editar').click();
                        $('#txt_partName_edit').val(json.name);
                        $('#txt_partDesc_edit').val(json.description);
                        $('#range_partWeight_edit').val(json.weight);
                        $('#range_partWeight_edit').change();
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
                    console.log('Não há dados na Tabela Materiais');
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

    function deleteParts(m) {
        $.ajax({ //Função AJAX
            url: "app/part.php" //Arquivo php
            , type: "post" //Método de envio
            , data: { 
                'id' : m.id
                , 'func' : m.func
            } //Dados
            , success: function(d) { //Sucesso no AJAX
                console.log(d);
                if (isJson(d) && d != '[]') {
                    m = { func:'load' };
                    loadParts(m);
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

    function createNewTable(d,t) {
        t.html('');
        table = $('<table class="table table-striped"></table>');

        thead = $('<thead></thead>');
        tbody = $('<tbody></tbody>');

        console.log(Object.keys(d[0]));

        var th = Object.keys(d[0]);
        tr = $('<tr></tr>');
        thead.append(tr);
        for(i of th){
            thead.append($('<th>' + i + '</th>'));
        }
        thead.append($('<th> actions </th>'));
        table.append(thead);

        for(r of d){
            tr = $('<tr></tr>');
            for(i of th) {
                var cont;
                r[i] === null ? r[i] = '' : '';
                if (r[i].length > 30) {
                    cont = r[i].substring(33, 0).trim().concat('...');
                    tr.append($('<td id="expand-data-row-' + r.id + '-col-' + i + '" class="expandable-on-click" data-value="' + r.id + '" data-func="loadItem" data-field="' + i + '">' + cont + '</td>'));
                }
                else {
                    cont = r[i];
                    tr.append($('<td>' + cont + '</td>'));
                }
            }
            btnEdit = $('<i class="material-icons" style="padding: 0 2px;"> <button type="button" id="item-edit-' + r.id + '" data-value="' + r.id + '" data-func="edit" class="btn btn-warning"> edit  </button> </i>');
            btnDelete = $('<i class="material-icons" style="padding: 0 2px;"> <button type="button" id="item-delete-' + r.id + '" data-value="' + r.id + '" data-func="delete" class="btn btn-danger"> delete_forever </button> </i>');
            td = $('<td> </td>');
            td.append(btnEdit);
            td.append(btnDelete);
            tr.append(td);
            tbody.append(tr);
        }
        table.append(tbody);

        $('#table-container').append(table);
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