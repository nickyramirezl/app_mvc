let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(t.classList.remove("ocultar"),e.classList.add("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent="$ "+a;const c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=t,c.onclick=function(){seleccionarServicio(e)},c.appendChild(n),c.appendChild(r),document.querySelector("#servicios").appendChild(c)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function idCliente(){cita.id=document.querySelector("#id").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(e.target.value="",mostrarAlerta("Hora no válida","error",".formulario")):cita.hora=e.target.value}))}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const r=document.createElement("DIV");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(o).appendChild(r);a&&setTimeout(()=>{r.remove()},4e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, fecha u hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,r=document.createElement("H3");r.textContent="Resumen de servicios",e.appendChild(r),n.forEach(t=>{const{id:o,precio:a,nombre:n}=t,r=document.createElement("DIV");r.classList.add("contenedor-servicio");const c=document.createElement("DIV");c.textContent=n;const i=document.createElement("P");i.innerHTML="<span>Precio: </span> $"+a,r.appendChild(c),r.appendChild(i),e.appendChild(r)});document.createElement("H3").textContent="Resumen de cita",e.appendChild(r);const c=document.createElement("P");c.innerHTML=`\n        <span>Nombre: </span> ${t}\n    `;const i=new Date(o),s=i.getMonth(),d=i.getDate()+2,l=i.getFullYear(),u=new Date(Date.UTC(l,s,d)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),m=document.createElement("P");m.innerHTML=`\n        <span>Fecha: </span> ${u}\n    `;const p=document.createElement("P");p.innerHTML=`\n        <span>Hora: </span> ${a} horas\n    `;const v=document.createElement("BUTTON");v.classList.add("boton"),v.textContent="Reservar Cita",v.onclick=reservarCita,e.appendChild(c),e.appendChild(m),e.appendChild(p),e.appendChild(v)}async function reservarCita(){const{nombre:e,fecha:t,hora:o,servicios:a,id:n}=cita,r=a.map(e=>e.id),c=new FormData;c.append("usuario_id",n),c.append("fecha",t),c.append("hora",o),c.append("servicios",r);try{mostrarModalRegistrando();const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:c});(await t.json()).resultado&&(Swal.close(),Swal.fire({icon:"success",title:"Cita creada",text:"Tu cita fue creada correctamente",button:"OK"}).then(()=>{setTimeout(()=>{window.location.reload()},1e3)}))}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la cita"})}}function mostrarModalRegistrando(){Swal.fire({title:"Registrando cita",timerProgressBar:!0,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1,didOpen:()=>{Swal.showLoading()}})}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));