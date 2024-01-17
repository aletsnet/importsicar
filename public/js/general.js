let tmp_table = [];

const display_elemento_modal = (modal, elemento) => {
    const list_elemento = document.getElementsByClassName(modal);
    for(let i = 0; i < list_elemento.length; i++){
        list_elemento[i].style="display: none;";
        if(i == elemento -1){
            list_elemento[i].style="display: normal;";
        }
    }
}

const load_table = (tabla, cols, datos, url) => {
    //botones
    const div_search = document.getElementById(tabla);
    const buttons = div_search.getElementsByClassName('pagination');
    const thead_default = div_search.getElementsByTagName('thead');
    const tbody_default = div_search.getElementsByTagName('tbody');

    let headers = '';
    let tbody = '';
    let btns = "";
    let i = 0;
    let status_tables = tmp_table.find(e => e.div === tabla)
    if(typeof status_tables == "undefined" ){
        tmp_table.push({div: tabla, cols: cols, url: url });
    }
    

    if(typeof datos.links != "undefined"){
        let f = datos.links.length;        
        datos.links.map( (item) => {
            let url_tmp = null;
            
            if(typeof url == 'undefined'){
                url_tmp = item.url;
            }else{
                if(item.url !== null){
                    let link = item.url.split("?");
                    url_tmp = url + "&" + link[1];
                }
            }

            let label = item.label;
            if(i==0){
                label = 'Primero';
            }
            if(i==f-1){
                label = 'Ultimo'
            }
            btns += `<li class="page-item ` + (item.active ? `active` : ``) + `">
                <a class="page-link" href="javascript:paginado('` + tabla + `','` + url_tmp + `')" aria-label="` + label + `">` + label + `</a>
            </li>`;
            i++;
        });
    }

    for(let i in cols){
        if(typeof cols[i] == 'object'){
            if(i == 'tools'){
                headers += '<th> Tools </th>';
            }else{
                switch(cols[i].length){
                    case 1:
                        headers += '<th scope="col">' + cols[i][0] + '</th>' ;
                        break;
                    case 2:
                        headers += '<th scope="col">' + cols[i][1] + '</th>' ;
                        break;
                    case 3:
                        headers += '<th class=' + cols[i][2] + ' scope="col">' + cols[i][1] + '</th>' ;
                        break;
                    default:
                        headers += '<th scope="col">' + cols[i] + '</th>' ;
                        break;
                }
            }
        }else{
            headers += '<th>' + cols[i] + '</th>' ;
        }
    }
    

    thead_default[0].innerHTML = '<tr>' + headers + '</tr>' ;

    datos.data.map((item) => {
        let cells = "";
        let scope = "" ;
        for(let i in cols){
            if(i == 'tools'){
                let elements = cols[i];
                cells += '<td> <span>';
                for(let ii in elements){
                    switch(elements[ii].type){
                        case 'button':
                            cells += `<button type="button" class="`+ elements[ii].class +`" 
                                              onclick="` + elements[ii].function.replace('?', item[elements[ii].param]) + `"
                                              `+(elements[ii].propiedades ?? '')+`> `+ `
                                              <i class="`+ elements[ii].icon +`"></i> 
                                              ` + elements[ii].label + ` 
                                      </button>` ;
                        break;
                        case 'link':
                            cells += `<a class="`+ elements[ii].class +`" 
                                         href="` + elements[ii].url.replace('?', item[elements[ii].param]) + `" 
                                         `+(elements[ii].propiedades ?? '')+`> `+ `<i class="`+ elements[ii].icon +`"></i> ` + elements[ii].label + ` </a>` ;
                        break;
                        default :
                            cells += elements[ii].label;
                        break;
                    }
                }
                cells += '</span></td>';
            }else{
                let campos = cols[i][0].split(",");
                let label = "";
                for(let j=0; j<campos.length; j++){
                    let c = campos[j].split(".");
                    switch (c.length) {
                        case 1:
                            label += (label!=""?" ":"") + (item[c[0].trim()] ?? '-');
                            break;
                        case 2:
                            label += (label!=""?" ":"") + item[c[0].trim()][c[1]];
                            break;
                        case 3:
                            label += (label!=""?" ":"") + item[c[0].trim()][c[1]][c[2]];
                            break;
                        default:
                            label += (label!=""?" ":"") + (item[c[0].trim()] ?? '-');
                            break;
                    }
                }
                if(label.length > 100){
                    label = label.slice(0, 97) + '...';
                }
                if(scope != ""){
                    cells += '<td>' + label + '</td>' ;
                }else{
                    scope = "row";
                    cells += '<td scope = "row">' + label + '</td>' ;
                }
                
            }
        }
        tbody += '<tr>' + cells + '</tr>'
    });

    if(tbody == ''){
        tbody = '<tr><td colspan="'+Object.keys(cols).length+'">No hay elementos que mostrar</td></tr>';
    }

    tbody_default[0].innerHTML = tbody ;
    buttons[0].innerHTML = btns;
}

const load_data = (tabla, cols, data2) => {
    //botones
    const div_search = document.getElementById(tabla);
    const buttons = div_search.getElementsByClassName('pagination');
    const thead_default = div_search.getElementsByTagName('thead');
    const tbody_default = div_search.getElementsByTagName('tbody');

    let headers = '';
    let tbody = '';
    let btns = "";
    let i = 0;

    for(let i in cols){
        if(typeof cols[i] == 'object'){
            if(i == 'tools'){
                headers += '<th> Tools </th>' ;
            }else{
                headers += '<th>' + cols[i][1] + '</th>' ;
            }
        }else{
            headers += '<th>' + cols[i] + '</th>' ;
        }
    }

    thead_default[0].innerHTML = '<tr>' + headers + '</tr>' ;

    data2.map((item) => {
        let cells = "";
        for(let i in cols){
            if(i == 'tools'){
                let elements = cols[i];
                for(let ii in elements){
                    switch(elements[ii].type){
                        case 'button':
                            cells += `<td> <button type="button" class="`+ elements[ii].class +`" onclick="` + elements[ii].function.replace('?', item[elements[ii].param]) + `" `+elements[ii].propiedades+`> `+ `<i class="`+ elements[ii].icon +`"></i> ` + elements[ii].label + ` </button></td>` ;
                        break;
                        default :
                            cells += '<td>' + elements[ii].label + '</td>' ;
                        break;
                    }
                }
            }else{
                let campos = cols[i][0].split(",");
                let label = "";
                for(let j=0; j<campos.length; j++){
                    let c = campos[j].split(".");
                    if(c.length == 1){
                        label += (label!=""?" ":"") +item[c[0]];
                    }else{
                        label += (label!=""?" ":"") + item[c[0]][c[1]];
                    }
                }
                cells += '<td>' + label + '</td>' ;
            }
            
        }
        tbody += '<tr>' + cells + '</tr>'
    });

    if(tbody == ''){
        tbody = '<tr><td colspan="'+Object.keys(cols).length+'">No hay elementos que mostrar</td></tr>';
    }

    tbody_default[0].innerHTML = tbody ;
    //buttons[0].innerHTML = btns;
}

const load_select = (origen, destino, controll, val_default, parametros) => {
    const select = document.getElementById(destino);
    select.innerHTML = '<option> Loading ...</option>';
    let value_obj = '';
    if(typeof origen == 'object'){
        value_obj = origen.value;
    }
    param = { param: value_obj } ;
    if(typeof parametros == 'object' ){
        parametros.map((item) => {
            let tmp = document.getElementById(item).value;
            console.log('{ "'+item+'" : "'+tmp+'" }');
            let obj = JSON.parse('{ "'+item+'" : "'+tmp+'" }');
            param = {...param, ... obj};
        });
    }
    axios.get(controll,{ params: param })
        .then(
            function (result) {
                list = result.data;
                options = '';
                
                for(i in list){
                    let selected = '';
                    if(typeof val_default != 'undefined'){
                        if(list[i].valor == val_default){
                            selected = 'selected = "selected"';
                        }
                    }
                    options += '<option value="'+list[i].valor+'" '+selected+'>'+list[i].label+'</option>';
                }

                if(options == ''){
                    options = '<option> - </option>';
                }else{
                    options = '<option> - </option>' + options;
                }
                
                select.innerHTML = options
                if(typeof select.attributes.onchange == 'object'){
                    console.log(select.attributes.onchange.nodeValue);
                    eval(select.attributes.onchange.nodeValue);
                }
            }
        )
        .catch(function (error) {
            console.log(error);
            select.innerHTML = '<option> Error ...</option>';
        });
    
}

const paginado = (tabla, url) => {
    cols = tmp_table.filter( (item)  => { return item.div == tabla});
    axios.get(url,{})
    .then(
        function (result) {
            load_table(tabla,cols[0].cols,result.data,cols[0].url);
        }
    )
    .catch(function (error) {
        console.log(error);
    });
}

const click_obj = (element) => {
    console.log(element);
    document.getElementById(element).click();
}

const modal_close = (name_modal) => {
    const modal = document.getElementById(name_modal);
    const newbutton = modal.getElementsByClassName("newbutton");
    if(newbutton.length === 0){
        const link = document.createElement('a');
        link.className = "newbutton";
        link.setAttribute("data-bs-dismiss","modal");
        modal.appendChild(link);
        const tmp = modal.getElementsByClassName("newbutton");
        tmp[0].click();
    }
    newbutton[0].click();
    return null;
}