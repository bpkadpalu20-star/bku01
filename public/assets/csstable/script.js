var simple_pdf_btn = document.getElementById('simple_pdf')
var html_pdf_btn = document.getElementById('html_pdf')
window.simple_pdf = function(){
    var container = document.getElementById('simple_pdf_container')
    let pdf = new jsPDF();

    var p = container.querySelectorAll('p')
    var line = 10;
    p.forEach(el => {
        pdf.text(pdf.splitTextToSize(el.innerText, 180), 10,line);
        line += 10
    })
    pdf.save('simple_pdf.pdf')
}

window.html_pdf = function(){
    var container = document.getElementById('html_pdf_container').cloneNode(true)
   
    let pdf = new jsPDF('p', 'pt', 'letter');
    container.querySelectorAll('table').forEach(el=>{
        el.removeAttribute('class')
        el.style.borderCollapse = 'collapse'
        el.style.width = '100%'
        el.querySelectorAll('td, th').forEach(cell=>{
            cell.style.border = '1px solid'
        })
    })
        console.log(container.innerHTML)
   
    pdf.html(`<div style='position:absolute;left:0; top:0; bottom:0; height:auto; width:600px; padding:10px;'>${container.innerHTML}<div>`, {
            callback: function (pdf) {
                pdf.save('html_pdf.pdf')
                // var iframe = document.createElement('iframe');
				// iframe.setAttribute('style', 'position:absolute;right:0; top:0; bottom:0; height:100%; width:500px');
				// document.body.appendChild(iframe);
				// iframe.src = pdf.output('datauristring');
            },
            windowWidth: 100
        }
    )
    // pdf.save('html_pdf.pdf')
}

window.onload = function(){

    simple_pdf_btn.addEventListener('click', function(e){
        e.preventDefault()
        simple_pdf()
    })

    html_pdf_btn.addEventListener('click', function(e){
        e.preventDefault()
        html_pdf()
    })
}