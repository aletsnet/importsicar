@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12" id="showSearch" >
            <div class="card border ">
                <div class="card-body">
                    <form id="search_form" action="javascript:void(0);">
                        <div class="row m-1">
                            <div class="col-12" id="msj_general">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div class="alert_mensaje"> </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="form-label">Sesion Activa:</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-select" aria-label="lasesion" id="space" name="space" onchange="search_table()">
                                    @foreach ($spaces as $item)
                                        <option {{ $item->status == '1003' ? 'selected' : '' }} value="{{$item->id}}">{{$item->proceso}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary" id="newspace" name="newspace" onclick="new_space()">Nuevo sesion</button>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-12">
                                <div class="input-group ">
                                    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modalForm" onclick = "nuevo();">
                                        <i class="bx bx-plus label-icon"></i> Nuevo
                                    </button>
                                    <input type="text" id="search" name="search" autofocus class="form-control" onkeypress="clickPress(event)" value = "{{ $search ?? ''}}">
                                    <button type="button" class="btn btn-info " onclick = 'search_table();'>
                                        <i class="bx bx-search label-icon"></i> Buscar
                                    </button>
                                    <button type="button" class="btn btn-success "  data-bs-toggle="modal" data-bs-target="#upFileModal">
                                        <i class=" ri-file-excel-line "></i> Excel
                                    </button>
                                    <button type="button" class="btn btn-danger " onclick = 'formSubmit();'>
                                        <i class="bx bxs-file-pdf label-icon"></i> PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-striped-columns mb-0">
                            <thead class="table-light" >
                                <tr>
                                    <th scope="col">
                                        Nombre
                                    </th>
                                    <th scope="col">
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        No hay elementos a mostrar
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination Small -->
                            <nav aria-label="Escuelas">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upFileModal" tabindex="-1" aria-labelledby="Subir archivo excel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir archivo excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card_body">
                        <div class="row p-1">
                            <div class="col-3">
                                <label class="">Subir archivo</label>
                            </div>
                            <div class="col-9">
                                <input type="file" class="form-control" id="upfilexls" placeholder="Imagen a subir" onchange="fileup_xls()" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                        </div>
                        <div class="row p-1" id="botup" style="display:none;">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" id="btnproceso" onclick="save_file()">Procesar</button>
                                <label id="proceso"></label>
                            </div>
                        </div>
                        <div class="col-12" id="msj_upfile">
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div class="alert_mensaje"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="table-xls">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Elemetos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Sin datos que mostrar
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script-page')
<script src="{{ URL::asset('js/general.js') }}"></script>
<script>
    const url_pro = "{!! asset('/') !!}";
    const sesion = document.getElementById("space");
    let data_files = [];

    const clickPress = (event) => {
        if (event.key == "Enter") {
            search_table();
        }
    }

    const alert_mensaje = (div, msj, activo) => {
        const contendor = document.getElementById(div);
        const mensaje = contendor.getElementsByClassName('alert_mensaje')[0];
        contendor.style = activo ? "display: normal;" : "display: none";
        mensaje.innerHTML = msj;
    }

    const search_table = (page) => {
        const buscar = document.getElementById("search");
        let ruta = url_pro  + 'lista/' + sesion.value + "/s" + (buscar.value != "" ? "/"+buscar.value : "/@") ;
        alert_mensaje("msj_general","Espere mientras esta cargando", true);
        axios.get(ruta , {})
            .then(
                function (result) {
                    const cols = {
                        col1:['color', 'Color'],
                        col2:['lote', 'Lote'],
                        col3:['paquete', 'Paquete'],
                        col4:['kilos', 'Kilos'],
                        col5:['costo', 'Costo'],
                        tools:[{
                            col:"*",
                            type:"button",
                            label:"Editar",
                            function:"editar(?)",
                            param:'id',
                            propiedades:' data-bs-toggle="modal" data-bs-target="#modalForm" ',
                            class:"btn rounded-pill btn-success waves-effect waves-light m-1",
                            icon:"bx bxs-edit-alt"
                        },{
                            col:"*",
                            type:"button",
                            label:"Eliminar",
                            function:"delete_item(?)",
                            param:'id',
                            propiedades:'',
                            class:"btn rounded-pill btn-danger waves-effect waves-light m-1",
                            icon:" bx bx-trash  "
                        },
                        ,{
                            col:"*",
                            type:"button",
                            label:"Imprimir",
                            function:"print_item(?)",
                            param:'id',
                            propiedades:'',
                            class:"btn rounded-pill btn-danger waves-effect waves-light m-1",
                            icon:"  "
                        }]
                    }
                    
                    //load_table("showSearch",cols,result.data);
                    //load_table("showSearch",cols,result.data,ruta);
                    let datos = [];
                    for(const [key, value] of Object.entries(result.data)){
                        if(value != null){
                            datos.push(value);
                        }
                    }
                    load_data("showSearch",cols,datos);
                    alert_mensaje("msj_general","Ok", false);
                }
            )
            .catch(function (error) {
                console.log(error);
                alert_mensaje("msj_general","Error", true);
            });
    }

    const new_space = () => {
        if(confirm("¿Está seguro de iniciar un nuevo espacio de trabajo?")){
            let ruta = "{{ route('space.store')}}";
            param = { };
            axios.post(ruta, param, { headers: { 'Content-Type': 'multipart/form-data'} },)
            .then((result) => {
                load_select('', "space", "{{ route("space.index")}}", (space.options[space.selectedIndex].value * 1  + 1), 'search_table()');
            })
            .catch(function (error) {
                alert_mensaje("alert_general","Error: " + error,true);
                console.log(error);
            });

        }
    }

    const fileup_xls = () => {
        const subir_div = document.getElementById('upFileModal');
        const botup = document.getElementById('botup');
        botup.style="display:none;";

        let formData = new FormData();
        const file = subir_div.getElementsByTagName("input")[0];
        
        formData.append('file', file.files[0]);
        let ruta = url_pro  + 'lista/' + sesion.value + "/xls";
        alert_mensaje("msj_upfile","Procesando archivo",true);
        axios.post(ruta,
            formData, 
            { headers: { 'Content-Type': 'multipart/form-data'} },)
            .then(
                function (result) {
                    botup.style="display: normal;";
                    const data = result.data.data;
                    const cols = {
                        col1:['A', 'Color'],
                        col2:['B', 'Lote'],
                        col3:['C', 'Paquete'],
                        col4:['D', 'Kilos'],
                        col5:['E', 'Costo']}
                    
                    
                    //const data_s = JSON.stringify(data.file);

                    const data_file = JSON.parse(data.file);
                    let datos = [];
                    for(const [key, value] of Object.entries(data_file)){
                        if(value.A != "" || value.A != "null")
                            datos.push(value);
                    }
                    data_files = datos;
                    load_data('table-xls', cols, datos);
                    alert_mensaje("msj_upfile","OK",false);
                    file.value = "";
                }
            )
            .catch(function (error) {
                alert_mensaje("msj_upfile","Error: " + error, true);
                //label_error.style="display: normal;";
                //const err = error.response.data.errors;
                console.log(error);
            });
    }

    const save_file = async () => {
        const proceso = document.getElementById("proceso");
        const btnproceso = document.getElementById("btnproceso");
        const total = data_files.length;

        btnproceso.disabled = true;
        proceso.innerHTML = "0/" + total;

        let ruta = "{{ route('lista.store')}}";
        

        for(const [key, value] of Object.entries(data_files)){
            let param = value;
            param["space"] = space.value;
            await axios.post(ruta,param);
            proceso.innerHTML = key + "/" + total;
        }

        location.href = url_pro;
        
    }

    const delete_item = (id) => {
        let ruta = url_pro  + 'lista/' + id ;
        if(confirm("¿Está seguro de eliminar este registro ?")){
            axios.delete(ruta, {})
                .then(
                    function (result) {
                        search_table();
                    }
                )
                .catch(function (error) {
                    console.log(error);
                    search_table();
                });
        }
    }

    const print_item = (id) => {
        let ruta = url_pro  + 'lista/' + sesion.value + "/printer" ;
        let a = document.createElement('a');
        a.target="_blank";
        a.href = ruta + "/" +id;
        a.click();
    }

    setTimeout(function(){ search_table(); alert_mensaje("msj_upfile","ok",false)}, 1000);

    
</script>
@endsection
