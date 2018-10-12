<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        My Profile
                    </div>

                    <div class="panel-body">
                        <div id="capture" style="padding: 10px; background: #f5da55">
                            <h4 style="color: #000; ">Hello world!</h4>
                        </div>
                            <p id="ignorePDF">don't print this to pdf</p>
                            <div>
                            <p><font size="3" color="red">print this to pdf</font></p>
                            </div>
                            <button type="button" @click="genratePDF">PDF</button>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</template>
 
<script>
import * as jsPDF from 'jspdf'
import html2canvas from 'html2canvas';
    export default {
        data(){
            return {}
        },
        mounted()
        {
 
        },
        methods: {
            genratePDF() {
                html2canvas(document.querySelector("#capture")).then(canvas => {
                    document.body.appendChild(canvas)
                	var doc = new jsPDF();
                	var elementHandler = {
                	'#ignorePDF': function (element, renderer) {
	                    return true;
    	            }
                	};
                	var source = window.document.getElementsByTagName("body")[0];
                	console.log(source)
                	doc.fromHTML(source,15,15,{'width': 180,'elementHandlers': elementHandler})
                	doc.save('a4.pdf');
                });
            }
        }
    }
</script>