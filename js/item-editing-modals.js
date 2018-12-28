/*ADD*/
var type = "";
function clckAdd(typ) {
    type = typ;
}
function addType(el) {
    let naming = document.getElementById("naming").value;
    let select = document.getElementById(type);
    $.get( "back/admin.php?create="+encodeURIComponent(type)+"&value="+ encodeURIComponent(naming),
        function( data ) {
            //$( ".result" ).html( data );
            console.log( "Load was performed. " + data);

            let op = document.createElement('option');
            op.value = data;
            op.innerText = naming;
            select.appendChild(op);

            document.getElementById("addStatus").style.display = "block";
            document.getElementById("addStatusText").innerText = "Готово";
            setTimeout(function(){ $("#createModal").modal("hide");document.getElementById("addStatus").style.display = "none"; }, 1000);
        }
    );

    document.getElementById("addStatus").style.display = "block";
    document.getElementById("addStatusText").innerText = "Сохранение...";
    console.log("SEND "+naming);
}

/*EDIT OR DELETE*/
var editText = "";
var editValue = "";

function clckEdit(typ) {
    type = typ;
    let select = document.getElementById(type);
    let i = select.options.selectedIndex;
    editText = select[i].text;
    editValue = select[i].value;
    document.getElementById("editNaming").value = editText;
}

function editType(el) {
    let naming = document.getElementById("editNaming").value;
    let select = document.getElementById(type);

    let _editValue = editValue;

    $.get( "back/admin.php?type="+encodeURIComponent(type)+"&edit="+encodeURIComponent(_editValue)+"&value="+ encodeURIComponent(naming),
        function( data ) {
            //$( ".result" ).html( data );
            console.log( "Load was performed. " + data);
            for(let i = 0;i<select.options.length;i++){
                if(select.options[i].value == _editValue){
                    select.options[i].text = naming;
                }
            }
            document.getElementById("editStatus").style.display = "block";
            document.getElementById("editStatusText").innerText = "Готово";
            setTimeout(function(){ $("#editModal").modal("hide");document.getElementById("editStatus").style.display = "none"; }, 1000);
        }
    );
    document.getElementById("editStatus").style.display = "block";
    document.getElementById("editStatusText").innerText = "Сохранение...";
    console.log("SEND "+naming);
}

function delType(el) {
    let select = document.getElementById(type);
    let _editValue = editValue;

    $.get( "back/admin.php?type="+encodeURIComponent(type)+"&del="+encodeURIComponent(_editValue),
        function( data ) {
            //$( ".result" ).html( data );
            console.log( "Load was performed. " + data);
            for(let i = 0;i<select.options.length;i++){
                if(select.options[i].value == _editValue){
                    select.options.remove(i);
                }
            }
            document.getElementById("editStatus").style.display = "block";
            document.getElementById("editStatusText").innerText = "Готово";
            setTimeout(function(){ $("#editModal").modal("hide");document.getElementById("editStatus").style.display = "none"; }, 1000);
        }
    );
    document.getElementById("editStatus").style.display = "block";
    document.getElementById("editStatusText").innerText = "Сохранение...";
    console.log("SEND ");
}