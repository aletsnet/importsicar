let list_files = [];

const subir_archivo = (div, url) => {
    const subir_div = document.getElementById(div);
    const label_error = subir_div.getElementsByClassName("label_error")[0];

    document.documentElement.setAttribute("data-preloader", "enable");

    let formData = new FormData();
    const file = subir_div.getElementsByTagName("input")[0];
    const select = subir_div.getElementsByTagName("select")[0];
    
    formData.append('file', file.files[0]);
    
    axios.post(url+"/"+select.value,
        formData, 
        { headers: { 'Content-Type': 'multipart/form-data'} },)
        .then(
            function (result) {
                label_error.style="display: none;";
                const data = result.data.data;
                document.documentElement.setAttribute("data-preloader", "disable");
                list_files.push({nombre: data.name, archivo: data.url, tipo: select.value});
                load_file(div);
                file.value = "";
                select.value = "";
            }
        )
        .catch(function (error) {
            label_error.style="display: normal;";
            const err = error.response.data.errors;
            const message = label_error.getElementsByClassName("error_message");
            let tmp_message = "";
            for(let i in err) {
                tmp_message += '<li>' + err[i] + '</li>'
            }

            message[0].innerHTML = '<ul>' + tmp_message + '</ul>';
            document.documentElement.setAttribute("data-preloader", "disable");
        });
}

    const load_file = (div) => {
        const subir_div = document.getElementById(div);
        const archivos = subir_div.getElementsByClassName("archivos")[0];
        let btns = '';
        
        list_files.map((item) => { 
            btns += `
    <span>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop` + item.id + `" type="button" class="btn btn-primary btn-label waves-effect waves-light  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-file-pdf-line label-icon align-middle fs-16 me-2"></i> `+item.nombre+`
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop` + item.id + `">
                    <li><a class="dropdown-item" href="{!! asset('storage') !!}/`+item.archivo+`" target="_blank"><i class="ri-eye-line "></i> Ver archivo</a></li>
                    <li><a class="dropdown-item" href="javascript:delete_file('` + item.nombre + `',div)"> <i class=" ri-delete-bin-line "></i> Borrar</a></li>
                </ul>
            </div>
        </div>
    </span>`;
        });

        if(btns == ''){
            btns += '<a class="btn btn-outline-secondary btn-lg  waves-effect waves-light"><i class="ri-file-add-line"></i>...</a>';
        }
        archivos.innerHTML = btns;
    }

    const delete_file = (nombre,div) => {
        const arr = list_files.filter( (item) => { if(item.nombre == nombre) { return item} })
        if(arr.length > 0 ){
            if(confirm("Desea quitar este archivo \""+arr[0].nombre+"\" ")){
                for(let i in list_files){
                    if(list_files[i].nombre == nombre){
                        list_files.splice(i,1).shift();
                    }
                }
                load_file(div);
            }
        }
    }