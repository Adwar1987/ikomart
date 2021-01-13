//XOCP_SERVER_SUBDIR = '/sipeg';
function nl2br (str, is_xhtml) {
   var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
   return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}
_gel = function(a) { return document.getElementById(a); }
_gec = function(a) { return document.getElementsByClassName(a); }
var basicmatch = /[a-z0-9]/i;
var included_files = new Array();

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Byte';
   var k = 1000;
   var dm = decimals + 1 || 3;
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
   var i = Math.floor(Math.log(bytes) / Math.log(k));
   return (bytes / Math.pow(k, i)).toPrecision(dm) + ' ' + sizes[i];
}

function include_dom(script_filename) { var html_doc = document.getElementsByTagName('head').item(0); var js = document.createElement('script'); js.setAttribute('language', 'javascript'); js.setAttribute('type', 'text/javascript'); js.setAttribute('src', script_filename); html_doc.appendChild(js); return false; }
function include_once(script_filename) { if (!inArray(script_filename, included_files)) { included_files[included_files.length] = script_filename; include_dom(script_filename); } }
function include(script_filename) { include_dom(script_filename); }
function in_array(needle, haystack) { for (var i = 0; i < haystack.length; i++) { if (haystack[i] == needle) { return true; } } return false; }
function _fromMoney(str) { str = str.replace(/\./g,'');return str.replace(/\,/g,'.');}
function _compStr(a,b) { var ret = 0; for(var i=0;i<a.length;i++) { if(i>=b.length) { ret = 1; continue; } if(a.charCodeAt(i)==b.charCodeAt(i)) { continue; } else if (a.charCodeAt(i)>b.charCodeAt(i)) { ret = 1; } else { ret = -1; } if(ret!=0) { return ret; } } if(b.length>a.length&&ret==0) { ret = -1; } return ret; }
function ajaxInit() { var c=null; try { c=new ActiveXObject('Msxml2.XMLHTTP'); } catch(e) { try { c=new ActiveXObject('Microsoft.XMLHTTP'); } catch(ee) { c=null; } } if(!c&& typeof XMLHttpRequest!='undefined') { c=new XMLHttpRequest(); } return c; }
function recjsarray(code){ try { eval('var ret='+code); return ret; } catch(e) { return false; } }
function ctimer(cmd,ms){this.cmd=cmd;this.ms=ms;this.tp=0;}
ctimer.prototype.start=function(){if(this.tp>0)this.reset();this.tp=window.setTimeout(this.cmd,this.ms);}
ctimer.prototype.reset=function(){if(this.tp>0)window.clearTimeout(this.tp);this.tp=0;}
function ltrim(str){return str.replace(/^\s*/,'');}
function rtrim(str){return str.replace(/\s*$/,'');}
function trim(str) { return rtrim(ltrim(str)); }
function delay(milliseconds){var then,now;then=new Date().getTime();now=then;while((now-then)<milliseconds){now=new Date().getTime();}}
function getkeyc(e){if(document.layers)return e.which;else if(document.all)return event.keyCode;else if(document.getElementById)return e.keyCode;return 0;}
function urlencode(Va){if(encodeURIComponent) return encodeURIComponent(Va);if(escape) return escape(Va)}
function _geln(a) { return document.getElementsByTagName(a);}
function _dce(a) { return document.createElement(a); }
function _ajaxSend(a){var c=ajaxInit();if(c){c.open("GET",a,true);c.send(null)}}
function _move(o,x,y){var e=_gel(o);if(e){e.style.left=x;e.style.top=y;return true;}else{return false;}}
function fixE(a) { if(!a) return null; if(typeof a=="undefined") a=window.event; if(typeof a.layerX=="undefined") a.layerX=a.offsetX; if(typeof a.layerY=="undefined") a.layerY=a.offsetY; return a }
function oY(a) { return $(a).position().top; }
function oX(a) { return $(a).position().left; }
function uxx(a){a.parentNode.style.display="none";a.parentNode.style.display=""}
function u(a){ a.parentNode.style.display="none"; z=a.nextSibling; zp=a.parentNode; at = a; if(z) { zp.removeChild(a); zp.insertBefore(at,z); } else { zp.removeChild(a); zp.appendChild(at); } a.parentNode.style.display=""}
function _us(a,b){for(i=0;i<b.length;i++){if(a==b[i]){b.splice(i,1);return b;}}return false;}
var _af=null;
function __caf() {
   if(!_af) {
      var dv = _dce('div');
       dv.setAttribute('style','z-index:10000;-moz-border-radius:0px 0px 5px 5px;border-radius:0px 0px 5px 5px;opacity:0.3;height:30px;text-align:center;width:300px;background-color:#000000;position:fixed;color:white;visibility:hidden;top:0px;left:-150px;margin-left:50%;padding:4px;');
       _af = document.body.appendChild(dv);
       _af.dv = document.body.appendChild(_dce('div'));
       _af.dv.setAttribute('style','z-index:100001;text-align:center;width:300px;position:fixed;color:white;visibility:hidden;top:0px;left:-150px;margin-left:50%;padding:4px;paddinng');
       _af.dv.appendChild(progress_span(_caf.txt));
	 }
   _af.style.visibility='visible';
   _af.dv.style.visibility='visible';
}

function _caf(x) {
   _caf.msg_timeout = 5000;
   if(!_af) {
      var dv = _dce('div');
      dv.className = 'caf';
      _af = document.body.appendChild(dv);
      _af.dv = _af.appendChild(progress_span(_caf.txt));
   }
   switch(x.readyState) {
      case 4 :
         setTimeout('_hidcaf()',1000);
         break;
      default :
         _af.style.visibility='visible';
         break;
   }
}

function _hidcaf() {
   _af.style.visibility='hidden';
   if(_caf.msg) {
      _mf_msg(_caf.msg,_caf.msg_timeout);
      _caf.msg = null;
   }
}


var _mf = null;
function _mf_msg(text) {
   if(!_mf) {
      var dv = _dce('div');
      dv.className = 'mf';
      _mf = document.body.appendChild(dv);
      var span = _dce('span');
      _mf.span = _mf.appendChild(span);
      var img = _dce('img');
      img.style.position = 'absolute';
      img.style.top = '0.5em';
      img.style.right = '0.5em';
      img.style.cursor = 'pointer';
      img.style.opacity = '0.7';
      img.src = XOCP_SERVER_SUBDIR+'/images/close_button.gif';
      img.onclick = function() {
         _hidmf();
         if(_mf.to) clearTimeout(_mf.to);
      };
      _mf.appendChild(img);
   }
   _mf.span.innerHTML = text;
   $(_mf).fadeToggle(600);
   if(typeof arguments[1] !== 'undefined' ) {
      if(arguments[1]>0) {
         _mf.to = setTimeout('_hidmf()',arguments[1]);
      } 
   } else {
      _mf.to = setTimeout('_hidmf()',5000);
   }
}

function _hidmf() {
   if(_mf) {
      $(_mf).fadeToggle();
   }
}

function changecss(theClass,element,value) {
   var cssRules;

   var added = false;
   for (var S = 0; S < document.styleSheets.length; S++) {
      if (document.styleSheets[S]['rules']) {
         cssRules = 'rules';
      } else if (document.styleSheets[S]['cssRules']) {
         cssRules = 'cssRules';
      } else {
         //no rules found... browser unknown
         return;
      }
      
      for (var R = 0; R < document.styleSheets[S][cssRules].length; R++) {
         if (document.styleSheets[S][cssRules][R].selectorText == theClass) {
            if(document.styleSheets[S][cssRules][R].style.backgroundColor) {
               document.styleSheets[S][cssRules][R].style.backgroundColor = value;
               added=true;
               break;
            }
         }
      }
      
      if(!added){
         if(document.styleSheets[S].insertRule){
            document.styleSheets[S].insertRule(theClass+' { '+element+': '+value+'; }',document.styleSheets[S][cssRules].length);
            var X = document.styleSheets[S][cssRules].length;
            //alert(document.styleSheets[S][cssRules][X-1].cssText);
            trace('add css rule: '+theClass);
         } else if (document.styleSheets[S].addRule) {
            document.styleSheets[S].addRule(theClass,element+': '+value+';');
         }
      }
      
   }
}



/////////// DRAT AND DROG      
var p=0;       // interval ID
var drect=null;    // drag rectangle DIV
// this function return drag rectangle 2px border, grey color
function h() {
   if(!drect) {
      drect=document.createElement('DIV');
      drect.style.display='none';
      drect.style.position='absolute';
      drect.style.cursor='move';
      drect.style.zIndex='300';
      drect.style.border='2px solid #7777ee';
      drect.style.backgroundColor='#7777ee';
      drect.style.opacity=0.5;
      document.body.appendChild(drect);
   }
   return drect;
}
// hide drag rectangle
function q() {
   h().style.display='none';
}

// animate function
function s(a,c,b) {              // a adalah module, c adalah threshold
   var e=parseInt(h().style.left);     // e is x coordinat of drag rect
   var f=parseInt(h().style.top);      // f is y coordinat of drag rect
   var i=(e-oX(a))/b;                  // i is
   var j=(f-oY(a))/b;
   return setInterval( function() {
      if(b<1) {
         clearInterval(p);
         q();
         return
      }
      b-=1;
      e-=i;
      f-=j;
      h().style.left=parseInt(e)+'px';
      h().style.top=parseInt(f)+'px' },c/b)
}

function gsc_getquery(elt, q) { 
   q = ltrim(q); 
   q = q.replace('\s+', ' '); 
   if (q.length == 0 || !basicmatch.test(q)) { 
      gsc_emptyresults(elt); return ''; 
   } 
   if (elt.cq && (elt.cq == q || elt.tempQuery == q)) { 
      return ''; 
   } 
   elt.cq = q; 
   return q; 
}

function getCookieVal (offset) { var endstr = document.cookie.indexOf (";", offset); if (endstr == -1) { endstr = document.cookie.length; } return unescape(document.cookie.substring(offset, endstr)); }
function GetCookie (name) { var arg = name + "="; var alen = arg.length; var clen = document.cookie.length; var i = 0; while (i < clen) { var j = i + alen; if (document.cookie.substring(i, j) == arg) { return getCookieVal (j); } i = document.cookie.indexOf(" ", i) + 1; if (i == 0) break;  } return null; }
function SetCookie (name, value) { var argv = SetCookie.arguments; var argc = SetCookie.arguments.length; var expires = (argc > 2) ? argv[2] : null; var path = (argc > 3) ? argv[3] : null; var domain = (argc > 4) ? argv[4] : null; var secure = (argc > 5) ? argv[5] : false; document.cookie = name + "=" + escape (value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) + ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain)) + ((secure == true) ? "; secure" : ""); }

function parseForm(form_id) {
   var frm = _gel(form_id);
   if(frm) {
      var el = frm.elements;
      var ret='';
      for (var i=0;i<el.length;i++) {
         if(!el[i].name) continue;
         switch(el[i].type) {
            case 'radio':
            case 'checkbox':
               if(el[i].checked) {
                  ret += '@@'+el[i].name +'^^'+el[i].value
               }
               break;
            default:
               ret += '@@'+el[i].name +'^^'+el[i].value
               break;
         }
      }
      ret=urlencode(ret.substring(2));
      return ret;
   }
}

function _parseForm(form_id) {
   var frm = _gel(form_id);
   ret = '';
   if(frm) {
      var input = new Array('input','select','textarea','password','button');
      for(ix=0;ix<input.length;ix++) {
         var el = frm.getElementsByTagName(input[ix]);
         for (var i=0;i<el.length;i++) {
            if(!el[i].name) continue;
            switch(el[i].type) {
               case 'radio':
               case 'checkbox':
                  if(el[i].checked) {
                     ret += '@@'+el[i].name +'^^'+el[i].value
                  }
                  break;
               default:
                  ret += '@@'+el[i].name +'^^'+el[i].value
                  break;
            }
         }
      }
   }
   ret=urlencode(ret.substring(2));
   return ret;
}



function strPad(sText,sTextPad,nTextLen) {
   var nMissing = nTextLen - sText.toString().length;
   var ret = '';
   var padding = sTextPad.substring(0,1);
   if (nMissing > 0) {
      for (var i = 0; i < nMissing; i++) ret += padding;
   }
   ret+=sText;
   return ret;
}


function _dopick(uid,o_id,c_id,e) {
   e=fixE(e);
   _dopick.obj_id=o_id;
   var d = _gel('com_'+uid);
   d.origNextSibling=d.nextSibling;
   if(d) {
      _dopick.obj=d;
      _dopick.obj.dragged=false;
      var l=h();                             // l is drag rect
      ///// below : set location and dimension of drag rect
      ///// and show it
      clearInterval(p);
      _dopick.lastMouseX=e.clientX;
      _dopick.lastMouseY=e.clientY;
      l.style.left=parseInt(oX(d))+'px';
      l.style.top=parseInt(oY(d))+'px';
      l.style.height=parseInt(d.offsetHeight)+'px';
      l.style.width=parseInt(d.offsetWidth)+'px';
      l.style.display='block';
      document.onmousemove=_dodrag;
      document.onmouseup=_dodrop;
   }
   return false;
}

function _dodrag(e) {
   e=fixE(e);
   var b=e.clientY;
   var f=parseInt(h().style.top);
   var j,g;
   g=f+b-_dopick.lastMouseY;
   h().style.top=g+'px';
   _dopick.lastMouseY=b;
   if(_dopick.obj) {
      _dopick.obj.dragged=true;
      var po = _dopick.obj.parentNode;
      var dst = 100000000;
      var jg = null;
      var bg=0;
      for(var u=0;u<po.childNodes.length;u++) {
         if(po.childNodes[u].nodeName.toLowerCase()!='div') {
            continue;
         }
         if(_dopick.obj==po.childNodes[u]) {
            bg=_dopick.obj.offsetHeight;
            continue;
         }
         var ydis = Math.abs(g-oY(po.childNodes[u])+bg);
         if(isNaN(ydis)) continue;
         if(ydis<dst) {
            dst=ydis;
            jg=po.childNodes[u];
         }
      }

      if(jg!=null&&_dopick.obj.nextSibling!=jg) {
         po.insertBefore(_dopick.obj,jg);
      }
   }
   return false;
}

function translateIdCom(idn) {
   var inx = _gel(idn).value.split('=');
   return inx[1];
}

function translateIdParent(idn) {
   var inx = _gel(idn).value.split('=');
   return inx[0];
}

function _dodrop(e) {
   e=fixE(e);
   document.onmousemove=null;
   document.onmouseup=null;
   var nxtsbl=null;
   if(_dopick.obj.origNextSibling != _dopick.obj.nextSibling) {
      if(_dopick.obj.nextSibling.id.substring(4,8)=='sbcm') {
         nxtsbl='sbcm';
      } else {
         nxtsbl=translateIdCom(_dopick.obj.nextSibling.id.substring(4));
      }
      var p_o_id=translateIdParent(_dopick.obj.id.substring(4));
      var o_id=translateIdCom(_dopick.obj.id.substring(4));
      pjx_app_updateSubCom('up',p_o_id,o_id,nxtsbl,null);
   }
   if(_dopick.obj.dragged) {
      p=s(_dopick.obj,15,7);
   } else {
      q();
   }
   _dopick.obj=null;
}

function fetchNodeUp(d,sNode) {
   while(d!=null) {
      d=d.parentNode;
      if(d!=null&&sNode!=null&&d.nodeName.toLowerCase()==sNode.toLowerCase()) {
         return d;
      }
   }
   return null;
}

function fetchIdUp(d,Id) {
   while(d!=null) {
      d=d.parentNode;
      if(d!=null&&Id!=null&&d.id==Id) {
         return d;
      }
   }
   return null;
}

function _destroy(obj) { if(obj&&obj.parentNode) { obj.parentNode.removeChild(obj); obj=null; }}

var img_progress = new Image();

function progress_span() {
   
   /*
   var span = _dce('span');
   span.innerHTML = "<div class='container'>"
                  + "<div class='contentBar'>"
                  + "<div id='block_1' class='barlittle'></div>"
                  + "<div id='block_2' class='barlittle'></div>"
                  + "<div id='block_3' class='barlittle'></div>"
                  + "<div id='block_4' class='barlittle'></div>"
                  + "<div id='block_5' class='barlittle'></div>"
                  + "</div>"
                  + "</div>";
   return span;
   
   */
   
   /// old progress bar
   img_progress.src = XOCP_SERVER_SUBDIR+'/images/progress_bar.png';
   var imgx = document.createElement('img');
   imgx.src = img_progress.src;
   imgx.style.verticalAlign = 'middle';
   imgx.style.height = '10px';
   imgx.style.marginLeft = '7px';
   var span = document.createElement('span');
   span.style.fontWeight = 'normal';
   if(progress_span.arguments[1]) {
      span.setAttribute('id',progress_span.arguments[1]);
   }
   if(progress_span.arguments[0]) {
      span.innerHTML = progress_span.arguments[0];
   } else {
      span.innerHTML =' ... process';
   }
   span.insertBefore(imgx,span.firstChild);
   return span;
}

var img_circlewaitgrey = new Image();
img_circlewaitgrey.src = XOCP_SERVER_SUBDIR+'/images/srcajaxwait.gif';
img_circlewaitgrey.style.margin = '1px';
img_circlewaitgrey.style.height = '14px';
img_circlewaitgrey.style.verticalAlign = 'middle';

var img_next = new Image();
img_next.src = XOCP_SERVER_SUBDIR+'/images/next.gif';
img_next.style.margin = '2px';
var img_prev = new Image();
img_prev.src = XOCP_SERVER_SUBDIR+'/images/prev.gif';
img_prev.style.margin = '2px';
//img_prev = _dce('div');
//img_prev.innerHTML = '&lt;&lt;';
//img_next = _dce('div');
//img_next.innerHTML = '&gt;&gt;';

var last_ajax_id = 1;

function _make_ajax(_qq) {
   _make_id(_qq);
   _make_subres(_qq);
   _qq.setAttribute('autocomplete','off');
   
   _qq._query = function() {
      var q = '';
      if(_qq._get_param) {
         q = _qq._get_param();
      } else {
         if(_qq.value) {
            q = _qq.value;
            q = trim(q);
         }
      }
      if(_qq.getAttribute('type')=='text'&&q.length == 0) {
         _qq._showResult(false);
         if(_qq._inp_key) {
            _qq.onkeydown=_qq._inp_key;
         }
         return;
      }
      _qq._showProgress();
      _qq._cq = q;
      if(_qq._send_query) {
         _qq._send_query(q,_qq._success); 
      }
   };
   
   _qq._inp_key=function(e) {
      key = getkeyc(e);
      switch (key) { 
         case 27: 
            if(_qq.getAttribute('type')=='text') {
               _qq.value = '';
            }
            if(_qq._onescape) {
               _qq._onescape();
            }
            return false;
            break;
         case 13:
            _qq._query();
            e.cancelBubble = true;
            return false;
            break;
         case 8:
            var q = trim(_qq.value);
            if(q.length < 3) {
               _qq._showResult(false);
            }
            break;
         case 9:
            if(_qq._ontab) {
               _qq._ontab();
               e.cancelBubble=true;
               return false;
            }
            break;
         default:
            break;
      } 
      return true; 
   };
   
   _qq.onkeydown = _qq._inp_key;
   _make_success(_qq);
   _make_redraw(_qq);
   _make_result(_qq);
   _qq._reset = function() {
      _qq._data = new Array();
      _qq._data_count = 0;
      _qq.onkeydown=_qq._inp_key;
   };
   
}

function _make_dropdown(_qq) {
   _make_id(_qq);
   _make_subres(_qq);
   
   _qq._query = function() {
      var q = '';
      if(_qq._get_param) {
         q = _qq._get_param();
      }
      _qq._showProgress();
      if(_qq._send_query&&_qq._success) {
         _qq._send_query(q,_qq._success); 
      }
   };
   
   _qq._reset = function() {
      _qq._data = new Array();
      _qq._data_count = 0;
      //_qq.onkeydown=false;
   };
   
   _qq._finishShow = function() {
      document.onkeydown = _qq._nav_key;
   };
   
   _qq._finishHide = function() {
      document.onkeydown = null;
   };

   _make_success(_qq);
   _make_redraw(_qq);
   _make_result(_qq);
   _qq._dropdownized = true;
}

function __mov(id, idx) {
   var _qq = _gel(id);
   if(_qq) {
      _qq._selectedIndex = idx;
      // _qq.focus();
      _qq._highlightsel();
   }
}

function __mup(id) {
}
   
function __ocl(id,idx) {
   var _qq = _gel(id);
   if(_qq) {
      _qq._get_result(idx);
   }
}

function _make_subres(_qq) {
   _make_id(_qq);
   if(!_qq._subres_width) _qq._subres_width = 300;
   _qq._item_cnt = 10;
   if(_qq._page_len&&_qq._page_len>0) {
      _qq._item_cnt = _qq._page_len;
   }
   // setup div for results
   _qq._subres = document.createElement('div');
   _qq._subres.setAttribute('id',_qq.id+'_subres');
   _qq._subres.className = 'subres';
   _qq._subres.style.zIndex = '9999';
   _qq.parentNode.appendChild(_qq._subres);
   _qq._subres.style.width = (Math.max(parseInt(_qq.offsetWidth),_qq._subres_width))+'px';
   _qq._subres.style.left=parseInt(oX(_qq)-parseInt(_qq._subres.style.width)+parseInt(_qq.offsetWidth)) +'px';
   _qq._subres.style.top=parseInt(1+oY(_qq)+_qq.offsetHeight+12)+'px';
   
   _qq._rescount = document.createElement('div');
   _qq._rescount.style.display = 'none';
   _qq._rescount.setAttribute('id',_qq.id+'_rescount');
   _qq._rescount.className = 'rescount';
   _qq._rescount.style.zIndex = '9999';
   _qq.parentNode.appendChild(_qq._rescount);
   //_qq._subres.appendChild(_qq._rescount);
   _qq._rescount.style.width = (Math.max(parseInt(_qq.offsetWidth),_qq._subres_width))+'px';
   //_qq._rescount.style.height = '16px';
   _qq._rescount.style.left=parseInt(oX(_qq)-parseInt(_qq._subres.style.width)+parseInt(_qq.offsetWidth)) +'px';
   _qq._rescount.style.top=parseInt(1+oY(_qq)+_qq.offsetHeight)+'px';

   _qq._rescount.tbl = _qq._rescount.appendChild(document.createElement('table'));
   _qq._rescount.tbl.setAttribute('class','rescounttbl');
   _qq._rescount.tbl.setAttribute('border','0');
   _qq._rescount.tbl.setAttribute('width','100%');
   _qq._rescount.tbl.setAttribute('cellpadding','0');
   _qq._rescount.tbl.setAttribute('cellspacing','0');
   _qq._rescount.tbl.tbody = _qq._rescount.tbl.appendChild(document.createElement('tbody'));
   _qq._rescount.tbl.tr = _qq._rescount.tbl.tbody.appendChild(document.createElement('tr'));
   _qq._rescount.tbl.tr.td0 = _qq._rescount.tbl.tr.appendChild(document.createElement('td'));
   _qq._rescount.tbl.tr.td1 = _qq._rescount.tbl.tr.appendChild(document.createElement('td'));
   _qq._rescount.tbl.tr.td2 = _qq._rescount.tbl.tr.appendChild(document.createElement('td'));
   _qq._rescount.tbl.tr.td0.setAttribute('style','cursor:pointer;width:30px;text-align:center;;vertical-align:bottom;');
   _qq._rescount.tbl.tr.td2.setAttribute('style','cursor:pointer;width:30px;text-align:center;vertical-align:bottom;');
   _qq._rescount.tbl.tr.td1.style.textAlign = 'center';
   _qq._rescount.tbl.tr.td1.innerHTML = '';
   _qq._prev = _qq._rescount.tbl.tr.td0.appendChild(img_prev.cloneNode(true));
   _qq._next = _qq._rescount.tbl.tr.td2.appendChild(img_next.cloneNode(true));
   _qq._rescount.tbl.tr.td0.style.verticalAlign = 'middle';
   _qq._rescount.tbl.tr.td2.style.verticalAlign = 'middle';
   
   _qq._showResult=function() {
      if(_qq._showResult.arguments.length == 1 && _qq._showResult.arguments[0] == false) {
         _qq._subres.style.display = 'none';
         _qq._rescount.style.display = 'none';
         if(_qq._finishHide) {
            _qq._finishHide();
         }
         document.onclick = null;
      } else {
         var padx = parseInt(window.getComputedStyle(_qq,'').getPropertyValue('padding-right'));//+parseInt(window.getComputedStyle(_qq,'').getPropertyValue('padding-left'));
         padx = 0;
         _qq._subres.style.display = 'block';
         _qq._rescount.style.display = 'block';
         _qq._rescount.style.width = (Math.max(parseInt(_qq.offsetWidth)-padx,_qq._subres_width))+'px';
         _qq._subres.style.width = (Math.max(parseInt(_qq.offsetWidth)-padx,_qq._subres_width)+6)+'px'; /// 4 is padding
         var top = parseInt(1+oY(_qq)+_qq.offsetHeight);
         _qq._subres.style.top=parseInt(-10+top+_qq._rescount.offsetHeight)+'px';
         _qq._subres.style.paddingTop = '10px';
         _qq._rescount.style.top=top+'px';
         if(_qq._align&&_qq._align=='left') {
            _qq._subres.style.left=parseInt(oX(_qq)) +'px';
            _qq._rescount.style.left=parseInt(oX(_qq)) +'px';
         } else {
            _qq._subres.style.left=parseInt(oX(_qq)-parseInt(_qq._subres.style.width)+parseInt(_qq.offsetWidth))-padx +'px';
            _qq._rescount.style.left=parseInt(oX(_qq)-parseInt(_qq._subres.style.width)+parseInt(_qq.offsetWidth))-padx +'px';
         }
         if(_qq._finishShow) {
            _qq._finishShow();
         }
         if(!_qq._do_not_dsa) {
            if(!_qq._dropdownized)_dsa(_qq);
         }
         document.onclick = function() {
            _qq._showResult(false);
            document.onclick = null;
         };
      }

   };
   
   _qq._showProgress=function() {
      var padx = parseInt(window.getComputedStyle(_qq,'').getPropertyValue('padding-right'));//+parseInt(window.getComputedStyle(_qq,'').getPropertyValue('padding-left'));
      _qq._rescount.tbl.tr.td1.innerHTML = '';
      ///_qq._rescount.tbl.tr.td1.appendChild(img_circlewaitgrey.cloneNode(true));
      _qq._rescount.tbl.tr.td1.appendChild(progress_span(''));
      _qq._rescount.style.display = 'block';
      _qq._rescount.style.width = (Math.max(parseInt(_qq.offsetWidth)-padx,_qq._subres_width))+'px';
      _qq._rescount.style.top=parseInt(1+oY(_qq)+_qq.offsetHeight)+'px';
      _qq._prev.style.visibility = 'hidden';
      _qq._next.style.visibility = 'hidden';
      if(_qq._align&&_qq._align=='left') {
         _qq._rescount.style.left=parseInt(oX(_qq)) +'px';
      } else {
         _qq._rescount.style.left=parseInt(oX(_qq)-parseInt(_qq._rescount.style.width)+parseInt(_qq.offsetWidth))-padx +'px';
      }
      _qq._rescount.style.display = 'block';
   };
   
   _qq._nav_key=function(e) {
      key = getkeyc(e);
      switch (key) { 
         case 27: 
            _qq._showResult(false);
            if(_qq.getAttribute('type')=='text') {
               _qq.value = '';
            }
            if(_qq._inp_key) {
               _qq.onkeydown = _qq._inp_key;
            }
            if(_qq._onescape) {
               _qq._onescape();
            }
            e.cancelBubble=true;
            return false;
            break;
         case 37: // kiri
            if(_qq._subres.style.display == 'none' || _qq._data_count == 0) return;
            if(_qq._current_page == 0) {
               _qq._redraw_page(_qq._max_page-1);
            } else {
               _qq._redraw_page(_qq._current_page-1);
            }
            e.cancelBubble=true;
            if(_qq._onchange) {
               var idx = _qq._selectedIndex;
               _qq._onchange(_qq._resultId[idx],_qq._results[idx]);
            }
            return false;
            break;
         case 39: // kanan
            if(_qq._subres.style.display == 'none' || _qq._data_count == 0) return;
            if(_qq._current_page == (_qq._max_page-1)) {
               _qq._redraw_page(0);
            } else {
               _qq._redraw_page(_qq._current_page+1);
            }
            e.cancelBubble=true;
            if(_qq._onchange) {
               var idx = _qq._selectedIndex;
               _qq._onchange(_qq._resultId[idx],_qq._results[idx]);
            }
            return false;
            break;
         case 38: // atas
            if (_qq._data_count > 0 && _qq._subres.style.display == 'none') {
               _qq._showResult();
               return;
            }
            if (_qq._selectedIndex == (_qq._current_page*_qq._item_cnt)) { 
               _qq._selectedIndex = (_qq._current_page*_qq._item_cnt) + _qq._item_page - 1; 
            } else {
               _qq._selectedIndex--; 
            }
            _qq._highlightsel();
            if(_qq._onchange) {
               var idx = _qq._selectedIndex;
               _qq._onchange(_qq._resultId[idx],_qq._results[idx]);
            }
            return false; 
            break; 
         case 40: // bawah
            if (_qq._data_count > 0 && _qq._subres.style.display == 'none') { 
               _qq._showResult();
               return;
            } 
            if (_qq._selectedIndex == (_qq._current_page*_qq._item_cnt)+_qq._item_page-1) { 
               _qq._selectedIndex = _qq._current_page*_qq._item_cnt; 
            } else { 
               _qq._selectedIndex++; 
            } 
            _qq._highlightsel();
            if(_qq._onchange) {
               var idx = _qq._selectedIndex;
               _qq._onchange(_qq._resultId[idx],_qq._results[idx]);
            }
            return false; 
            break;
         case 13:
            e.cancelBubble=true;
            _qq._get_result(_qq._selectedIndex);
            return false;
            break;
         case 9:
            if(_qq._ontab) {
               _qq._ontab();
               e.cancelBubble=true;
               return false;
            }
            break;
         default:
            var q = '';
            if(_qq.value) {
               q = trim(_qq.value);
            }
            if(_qq._inp_key) {
               _qq.onkeydown = _qq._inp_key;
            }
            if(q.length < 2) {
               _qq._showResult(false);
               return;
            }
            break;
      } 
      return true; 
   };

   _qq._highlightsel=function() { 
      // divs = _qq._subres.getElementsByTagName('div'); 
      divs = _qq._subres.childNodes;
      for (var i = 0; i < divs.length; i++) { 
         if (((_qq._item_cnt*_qq._current_page)+i) == _qq._selectedIndex) { 
            divs[i].className = 'xsr_sel'; 
            _qq._temp_q = _qq._results[i];
            _qq._selectedDIV = divs[i];
            if(_qq._balon_call) {
               _qq._balon_call(_qq._results[i]);
            }
         } else { 
            divs[i].className = ((i%2)==0?'xsr0':'xsr1'); 
         } 
         
         if(i==(divs.length-1)&&divs[i].style.MozBorderRadius) {
            divs[i].style.MozBorderRadius = '0 0 5px 5px';
         }
      } 
   };
}

function _make_id(_qq) {
   if(!_qq.id) {
      var newid = '';
      while(1) {
         newid = 'qqid'+last_ajax_id;
         if(!_gel(newid)) {
            break;
         }
         last_ajax_id++;
      }
      _qq.setAttribute('id',newid);
   }
}

function _make_redraw(_qq) {
   _qq._redraw_page = function(p) {
      var _data = _qq._data;
      if(p<=_qq._max_page) {
         _qq._current_page = p;
         var i = p * _qq._item_cnt;
         var j = i+Math.min((_qq._data_count-i),_qq._item_cnt);
         _qq._item_page = j-i;
         _qq._numres = i;
         _qq._subres.innerHTML = '';
         _qq._selectedIndex = i;
         _qq._rescount.tbl.tr.td1.innerHTML = parseInt(i+1) + ' - ' + j + ' (' + _qq._data_count + ')';
         _qq._prev.style.visibility = 'visible';
         _qq._next.style.visibility = 'visible';
         _qq._rescount.tbl.tr.td0.onclick = function(e) {
            e.cancelBubble = true;
            if((p-1)>0) {
               _qq._redraw_page(p-1);
            } else {
               _qq._redraw_page(_qq._max_page-1);
            }
            _qq.focus();
            return false;
         };
         _qq._rescount.tbl.tr.td2.onclick = function(e) {
            e.cancelBubble = true;
            if((p+1)<_qq._max_page) {
               _qq._redraw_page(p+1);
            } else {
               _qq._redraw_page(0);
            }
            _qq.focus();
            return false;
         };
         for (i; i < j; i++) { 
            _qq._resultId[_qq._numres] = _data[i][1];
            _qq._results[_qq._numres] = _data[i][0]; 
            _qq._resData[_qq._numres] = _data[i];
            var _res = '<div class=\"xsr\"  onmouseover=\"__mov(\''+_qq.id+'\',\''+_qq._numres+'\');\" onclick=\"__ocl(\''+_qq.id+'\',\''+_qq._numres+'\');\">'
                     + '<table class=\"xsr\"><tbody><tr><td>'+_data[i][0]+'</td><td>'+_data[i][1]+'</td></tr></tbody></table>'
                     + '</div>';
            
            _qq._subres.innerHTML += _res;
            var data_id = _data[i][1];
            _qq._data_idx[data_id] = i;
            _qq._numres++;
         }
         _qq._highlightsel();
         _qq._showResult(true); 
      }
   };
}

function _make_success(_qq) {
   _qq._success = function(_data) { 
      if(_data=='EMPTY') {
         _qq._subres.innerHTML = '<div class="sr0"><span class="srt">Tidak ketemu.</span></div>';
         _qq._rescount.tbl.tr.td1.innerHTML = '0 - 0 (0)';
         _qq._data = new Array();
         _qq._data_count = 0;
         _qq._showResult();
         return;
      }
      if(_data=='JUSTBILL') {
         _qq._subres.innerHTML = '<div class="sr0"><span class="srt">Hasil belum diapprove.<br/>Silakan hubungi Lab. Patklin.</span></div>';
         _qq._rescount.tbl.tr.td1.innerHTML = '0 - 0 (0)';
         _qq._data = new Array();
         _qq._data_count = 0;
         _qq._showResult();
         return;
      }
      _data = recjsarray(_data);
      _qq._data = _data;
      _qq._data_count = _data.length;
      _qq._numres = 0;
      _qq._results = [];
      _qq._resultId = [];
      _qq._data_idx = [];
      _qq._resData = [];
      _qq._showResult(false);
      _qq._current_page = 0;
      _qq._max_page = Math.ceil(_data.length/_qq._item_cnt);
      if (_data.length > 0) {
         _qq._redraw_page(0);
         _qq.onkeydown=_qq._nav_key;
      } 
   };
   
}

function _make_result(_qq) {
   _qq._get_result = function(idx) {
      if(_qq._subres.style.display != 'block') {
         return;
      }
      var resultId = _qq._resultId[idx];
      var resultNm = _qq._results[idx];
      _qq._resVal = resultId;
      _qq._resNam = resultNm;
      _qq._resIdx = idx;
      _qq._resDat = _qq._resData[idx];
      // _qq._resData = _qq._resData[idx];
      
      if(_qq._onselect) {
         _qq._onselect(resultId,_qq._results[idx],_qq._resData[idx]);
      }
   };
}

function _make_timer(_qq) {
   // setup timer
   _qq.tp = 0;
   _qq.ms = 1;
   _qq.timer_start=function() {
      if(this.tp>0) this.timer_reset();
      this.tp=window.setTimeout(this._query,this.ms);
   };
   _qq.timer_reset=function() {
      if(_qq.tp>0) window.clearTimeout(_qq.tp);
      _qq.tp=0;
   };
}


function _mDropDown(_qq) {
   _make_id(_qq);
   _qq._page = document.createElement('div');
   _qq._page.setAttribute('id',_qq.id+'_subres');
   _qq._page.className = 'subres';
   _qq._page = document.body.appendChild(_qq._page);
   _qq.addData = function(data) {
      
   };
   
   _qq._show = function() {
   
   };
   
   _qq._hide = function() {
   
   };
}

   function sql2string(t) {
      var myear = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
      //var myear = new Array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
      var dttm = t.split(' ');
      var dt,tt;
      var y,m,d,hh,mm,ss;
      y=m=d=hh=mm=ss=null;
      dt = dttm[0].split('-');
      y=parseInt(dt[0]*1);
      m=parseInt(dt[1]*1);
      d=parseInt(dt[2]*1);
      var datestr='';
      if((m-1)<0) {
         return '????-??-??';
      }
      datestr += d+' '+myear[m-1]+' '+y;
      if(sql2string.arguments[1]=='datetime') {
         tt = dttm[1].split(':');
         datestr += ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2);
      } else if(sql2string.arguments[1]=='datetimesec') {
         tt = dttm[1].split(':');
         datestr += ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2)+':'+strPad(tt[2],'0',2);
      } else if(sql2string.arguments[1]=='time') {
         tt = dttm[1].split(':');
         datestr = ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2);
      } else if(sql2string.arguments[1]=='timesec') {
         tt = dttm[1].split(':');
         datestr = ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2)+':'+strPad(tt[2],'0',2);
      }
      return datestr;
   }

   function dttm2class(t) {
      var dttm = t.split(' ');
      var dt,tt;
      dt = dttm[0].split('-');
      tt = dttm[1].split(':');
      datestr = strPad(dt[0],'0',4)+strPad(dt[1],'0',2)+strPad(dt[2],'0',2)+strPad(tt[0],'0',2)+strPad(tt[1],'0',2)+strPad(tt[2],'0',2);
      return datestr;
   }


function doSelectAll(inp) {
   if(inp) {
      inp.selectionStart = 0;
      inp.selectionEnd = inp.value.length;
      inp.focus();
   }
}

function _dsa(inp) {
   if(inp) {
      inp.selectionStart = 0;
      inp.selectionEnd = inp.value.length;
      inp.focus();
   }
}

var ksave = 1;
function _savekey() {
   ksave.kd = document.onkeydown;
   ksave.kp = document.onkeypress;
   document.onkeydown = null;
   document.onkeypress = null;
}

function _revertkey() {
   document.onkeydown = ksave.kd;
   document.onkeypress = ksave.kp;
}

var dvfocus = null;
function setup_focus() {
   if(dvfocus) {
      close_focus();
   }
   
   var nm = uniqid();
   dvfocus = _dce('div');
   dvfocus.setAttribute('class','xfocus');
   dvfocus = document.body.appendChild(dvfocus);
   dvfocus.bg0 = _dce('div');
   dvfocus.bg0.setAttribute('class','xfocus_bg0');
   dvfocus.bg0 = dvfocus.appendChild(dvfocus.bg0);
   dvfocus.bg1 = _dce('div');
   dvfocus.bg1.setAttribute('class','xfocus_bg1');
   dvfocus.bg1 = dvfocus.bg0.appendChild(dvfocus.bg1);
   dvfocus.btn = _dce('div');
   dvfocus.btn.setAttribute('class','xfocus_dvbtn');
   dvfocus.btn = dvfocus.bg1.appendChild(dvfocus.btn);
   
   dvfocus.frame = _dce('div');
   dvfocus.frame.setAttribute('class','xfocus_frame');
   dvfocus.frame = dvfocus.bg1.appendChild(dvfocus.frame);
}

function close_focus() {
   _destroy(dvfocus.iframe);
   _destroy(dvfocus.frame);
   _destroy(dvfocus.bg1);
   _destroy(dvfocus.bg0);
   _destroy(dvfocus);
   dvfocus.frame = null;
   dvfocus.bg1 = null;
   dvfocus.bg0 = null;
   dvfocus = null;
}

function uniqid (prefix, more_entropy) {
   // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
   // +    revised by: Kankrelune (http://www.webfaktory.info/)
   // %        note 1: Uses an internal counter (in php_js global) to avoid collision
   // *     example 1: uniqid();    // *     returns 1: 'a30285b160c14'
   // *     example 2: uniqid('foo');
   // *     returns 2: 'fooa30285b1cd361'
   // *     example 3: uniqid('bar', true);
   // *     returns 3: 'bara20285b23dfd1.31879087'
   
   if (typeof prefix == 'undefined') prefix = "";

   var retId;
   var formatSeed = function (seed, reqWidth) {
      seed = parseInt(seed,10).toString(16); // to hex str
      if (reqWidth < seed.length) { // so long we split
         return seed.slice(seed.length - reqWidth);
      }
      if (reqWidth > seed.length) { // so short we pad
         return Array(1 + (reqWidth - seed.length)).join('0')+seed;
      }
      return seed;
   }; 
   // BEGIN REDUNDANT
   if (!this.php_js) {
      this.php_js = {};
   }
    // END REDUNDANT
   if (!this.php_js.uniqidSeed) { // init seed with big random int
      this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
   }
   this.php_js.uniqidSeed++; 
   retId  = prefix; // start with prefix, add current milliseconds hex string
   retId += formatSeed(parseInt(new Date().getTime()/1000,10),8);
   retId += formatSeed(this.php_js.uniqidSeed,5); // add seed hex string
   if (more_entropy) {
      // for more entropy we add a float lower to 10
      retId += (Math.random()*10).toFixed(8).toString();
   }
   return retId;
}


function thSep(nStr) {
	nStr += ' ';
	nStr = trim(nStr);
	var x = nStr.split(".");
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function _chcost(inp_id,sp_id,d,e) {
   var k = getkeyc(e);
   if(d.chgt) {
      d.chgt.reset();
      d.chgt = null;
   }
   d.chgt = new ctimer('_setspcost(\''+inp_id+'\',\''+sp_id+'\');',10);
   d.chgt.start();
}

function _setspcost(inp_id,sp_id) {
   var d = parseInt(_gel(inp_id).value);
   if(isNaN(d)) d = 0;
   _gel(sp_id).innerHTML = thSep(d);
}

assessment_modify_result = function() {
   return;
};

function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
   for (var i=0;i<vars.length;i++) {
      var pair = vars[i].split("=");
      if (pair[0] == variable) {
         return pair[1];
      }
   }
   // alert('Query Variable ' + variable + ' not found');
   return false;
} 


var _emp_list = new Array();
function _emp_init() {
   var d = _gel('_emp_q');
   if(d) {
      if(!d._get_param) {
         var doc_qemp = d;
         doc_qemp._get_param=function() {
            var qval = this.value;
            qval = trim(qval);
            if(qval.length < 2) {
               return '';
            }
            return qval;
         };
         
         doc_qemp._onselect=function(resId) {
            //_emp_list[] = resId;
         };
         
         doc_qemp._send_query = exjx_app_searchEmployee;
         _make_ajax(doc_qemp);
      }
   }
}

function _emp_reset() {
   _emp_list = new Array();
}

function _LOG(msg) { /// logging facility to javascript console
   try {
      netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
      var consoleService = Components.classes["@mozilla.org/consoleservice;1"]
                           .getService(Components.interfaces.nsIConsoleService);
      consoleService.logStringMessage(msg);
   } catch(e) {
      
   }
}

var _xocp_imgs = new Array();
function _preload_images(url) {
   var no = _xocp_imgs.length;
   no++;
   _xocp_imgs[no] = _dce('img');
   _xocp_imgs[no].src = url;
   return no;
}

function thumb_over(d,e) {
}

function thumb_out(d,e) {
}

function init_video(video_url,player) {
   
   $f('video_'+player, XOCP_SERVER_SUBDIR+'/include/flowplayer/flowplayer.commercial-3.2.7.swf', {
      
      'screen':{'height':'100pct','top':0},
      
      canvas: {
         backgroundColor:'rgba(100,100,100,0)',
         backgroundGradient:'none'
      },
      
      // now we can tweak the logo settings
      logo: {
         //url: 'logo10.png',
         fullscreenOnly: false,
         displayTime: 5,
         fadeSpeed: 2000,
         opacity:0.9,
         top:15,
         right:15
      },
      
      clip: {
         scaling:'fit',
         
         bufferLength:4,
         
         url: XOCP_SERVER_SUBDIR+video_url
      },
   
      // streaming plugins are configured under the plugins node
      plugins: {
         
         
         controls: {
            name:'controls',
            'timeFontSize':10,
            'timeSeparator':'/',
            'timeBorderRadius':20,
            'timeBgHeightRatio':0.8,
            'timeColor':'#ffffff',
            timeBgColor:'rgba(0,0,0,0.2)',
            durationColor:'#ffffff',
            
            url: XOCP_SERVER_SUBDIR+'/include/flowplayer/flowplayer.controls-3.2.5.swf',
            
            all: false,
            stop: true,
            play: true,
            mute: true,
            scrubber:true,
            time: true,
            volume: true,
            fullscreen: true,
            
            'bottom':0,
            
            opacity:1,
            
            backgroundColor:'rgba(40, 40, 40, 0.2)',
            backgroundGradient:'none',
            
            buttonColor:'#bbbbbb',
            builtIn:false,
            zIndex:1,
            height:26,
            
            display:'block',
            
            tooltipColor:'rgba(0,0,0,0)',
            tooltipTextColor:'#cccccc',
            tooltips:{marginBottom:5,buttons:true},
            
            'width':'100pct',
            
            'scrubberHeightRatio':0.5,
            'sliderBorder':'1px solid rgba(255, 255, 255, 0.2)',
            'sliderGradient':'none',
            'sliderColor':'rgba(0,0,0,0)',
            'progressColor':'rgba(255,0,0,0.5)',
            'bufferColor':'rgba(128,128,128,0.5)',
            bufferGradient:'none',
            
            
            volumeColor:'rgba(255,0,0, 0.5)',
            'volumeBorder':'1px solid rgba(255,255,255,0.2)',
            'volumeBarHeightRatio':0.3,
            'volumeSliderColor':'rgba(0,0,0,0.2)',
            
            'margins':[2,12,2,12],
            
            
            autoHide:{enabled:true,hideDelay:500,mouseOutDelay:500,hideStyle:'fade',hideDuration:400,fullscreenOnly:true},
            builtIn:false
         }
   
      }
      
   });
   
}

function init_streaming(connection_url,channel_nm) {
   
   $f('streaming_'+channel_nm, XOCP_SERVER_SUBDIR+'/include/flowplayer/flowplayer.commercial-3.2.7.swf', {
      
      'screen':{'height':'100pct','top':0},
      
      canvas: {
         backgroundColor:'rgba(100,100,100,0)',
         backgroundGradient:'none'
      },
      
      // now we can tweak the logo settings
      logo: {
         //url: 'logo10.png',
         fullscreenOnly: false,
         displayTime: 5,
         fadeSpeed: 2000,
         opacity:0.9,
         top:15,
         right:15
      },
      
      clip: {
         scaling:'fit',
         
         bufferLength:0,
         
         //url: 'N8inpasadena-Flowers457.flv'
         live: true,
         url: channel_nm,
         provider: 'influxis'
      },
   
      // streaming plugins are configured under the plugins node
      plugins: {
         
         
         controls: {
            name:'controls',
            'timeFontSize':10,
            'timeSeparator':'/',
            'timeBorderRadius':20,
            'timeBgHeightRatio':0.8,
            'timeColor':'#ffffff',
            timeBgColor:'rgba(0,0,0,0.2)',
            durationColor:'#ffffff',
            
            url: XOCP_SERVER_SUBDIR+'/include/flowplayer/flowplayer.controls-3.2.5.swf',
            
            all: false, 
            play: true,
            mute: true,
            scrubber:true,
            time: true,
            volume: true,
            fullscreen: true,
            
            'bottom':0,
            
            opacity:1,
            
            backgroundColor:'rgba(40, 40, 40, 0.2)',
            backgroundGradient:'none',
            
            buttonColor:'#bbbbbb',
            builtIn:false,
            zIndex:1,
            height:26,
            
            display:'block',
            
            tooltipColor:'rgba(0,0,0,0)',
            tooltipTextColor:'#cccccc',
            tooltips:{marginBottom:5,buttons:true},
            
            'width':'100pct',
            
            'scrubberHeightRatio':0.5,
            'sliderBorder':'1px solid rgba(255, 255, 255, 0.2)',
            'sliderGradient':'none',
            'sliderColor':'rgba(0,0,0,0)',
            'progressColor':'rgba(255,0,0,0.5)',
            'bufferColor':'rgba(128,128,128,0.5)',
            bufferGradient:'none',
            
            
            volumeColor:'rgba(255,0,0, 0.5)',
            'volumeBorder':'1px solid rgba(255,255,255,0.2)',
            'volumeBarHeightRatio':0.3,
            'volumeSliderColor':'rgba(0,0,0,0.2)',
            
            'margins':[2,12,2,12],
            
            
            autoHide:{enabled:true,hideDelay:500,mouseOutDelay:500,hideStyle:'fade',hideDuration:400,fullscreenOnly:true},
            builtIn:false
         },
   
         // here is our rtpm plugin configuration
         influxis: {
            url: XOCP_SERVER_SUBDIR+'/include/flowplayer/flowplayer.rtmp-3.2.3.swf',
   
            // netConnectionUrl defines where the streams are found
            netConnectionUrl: connection_url
         }
      }
   });
   
}

function isTouchDevice() {
   var ua = navigator.userAgent;
      var isTouchDevice = (
      ua.match(/iPad/i) ||
      ua.match(/iPhone/i) ||
      ua.match(/iPod/i) ||
      ua.match(/Android/i)
   );
   return isTouchDevice;
}

$(document).ready(function() {
   
   // initialize qtip
   init_qtip();
   
   // register animateHighlight method
   $.fn.animateHighlight = function (highlightColor, duration) {
      var highlightBg = highlightColor || "#FFFF9C";
      var animateMs = duration || 5000; // edit is here
      var originalBg = this.css("background-color");
      
      if (!originalBg || originalBg == highlightBg)
         originalBg = "transparent"; // default to white
         
      jQuery(this)
         .css("backgroundColor", highlightBg)
         .animate({ backgroundColor: originalBg }, animateMs, null, function () {
            jQuery(this).css("backgroundColor", originalBg); 
         });
   };
});

function init_qtip() {
   $('*[data-tooltip]').each(function() {
      if (!$(this).data('qtip')) {
         $(this).qtip({
            position:{
               my:'top left',
               at:'bottom center',
               adjust:{
                  y:2
               }
            },
            style:{
               classes:'qtip-rounded qtip-shadow'
            },
            content:{
               text: $(this).data('tooltip')
            }
         });
      }
   });
}

var inplace_editorx = null;
function inplace_edit(func,d,e) {
   if(inplace_editorx&&inplace_editorx.d) {
      if(inplace_editorx.d!=d) {
         inplace_editorx.style.display = '';
         inplace_editorx.d.style.display = '';
         _destroy(inplace_editorx);
         inplace_editorx = null;
      }
   }
   if(!inplace_editorx) {
      d.oldHTML = d.innerHTML;
      var p = d.parentNode;
      var editor = _dce('input');
      editor.setAttribute('class','inplace_editor');
      d.style.display = 'none';
      d.inplace_editor = p.insertBefore(editor,d);
      d.inplace_editor.value = d.innerHTML;
      _dsa(d.inplace_editor);
      d.inplace_editor.d = d;
      inplace_editorx = d.inplace_editor;
      inplace_editorx.d = d;
      d.inplace_editor.onkeydown=function(event) {
         var k = getkeyc(event);
         if(k==13) {
            var val = trim(this.value);
            if(val=='') val = 'Empty';
            this.d.innerHTML = val;
            this.style.display = 'none';
            this.d.style.display = '';
            if(func) {
               func.inplace_editor = this;
               func();
            }
            _destroy(inplace_editorx);
            inplace_editorx = null;
         } else if(k==27) {
            this.style.display = 'none';
            this.d.style.display = '';
            _destroy(inplace_editorx);
            inplace_editorx = null;
         }
      };
      d.inplace_editor.onblur=function() {
         this.style.display = 'none';
         this.d.style.display = '';
         _destroy(inplace_editorx);
         inplace_editorx = null;
      };
      $('.inplace_editor').preventDisableSelection();
   } else {
      d.style.display = 'none';
      d.inplace_editor.style.display = '';
      d.inplace_editor.value = d.innerHTML;
      _dsa(d.inplace_editor);
   }
}

$.fn.extend({
    preventDisableSelection: function(){
        return this.each(function(i) {
            $(this).bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(e) {
                e.stopImmediatePropagation();
            });
        });
    }
});

function toMoney(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/* 
decimal_sep: character used as deciaml separtor, it defaults to '.' when omitted
thousands_sep: char used as thousands separator, it defaults to ',' when omitted
*/
Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep)
{ 
   var n = this,
   c = isNaN(decimals) ? 2 : Math.abs(decimals), //if decimal is zero we must take it, it means user does not want to show any decimal
   d = decimal_sep || '.', //if no decimal separator is passed we use the dot as default decimal separator (we MUST use a decimal separator)

   /*
   according to [http://stackoverflow.com/questions/411352/how-best-to-determine-if-an-argument-is-not-sent-to-the-javascript-function]
   the fastest way to check for not defined parameter is to use typeof value === 'undefined' 
   rather than doing value === undefined.
   */   
   t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, //if you don't want to use a thousands separator you can pass empty string as thousands_sep value

   sign = (n < 0) ? '-' : '',

   //extracting the absolute value of the integer part of the number and converting to string
   i = parseInt(n = Math.abs(n).toFixed(c)) + '', 

   j = ((j = i.length) > 3) ? j % 3 : 0; 
   return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ''); 
}



function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

/// qicd10 begin
var edit_ditem = null;

function qicd10press(prev_id,panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      if(prev_id=='') {
         d._align='right';
      } else {
         d._align='left';
      }
      d.prev_id = prev_id;
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         if(_gel('grouper_result')) $('#grouper_result').fadeOut();
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var prevattrib = _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value;
         var single = _gel('qsingle_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         var attribs = prevattrib.split('|');
         if(single==1&&ids[0]!='') {
            this._showResult(false);
            alert('Please enter 1 diagnosis only');
            return;
         }
         if(in_array(id,ids)) {
            this._showResult(false);
            return;
         }
         
         var dc = _gel('qicd10container_'+this.panel_id+'_'+this.panel_item_id);
         if(this.prev_id!='') {
            var ditem = _gel('diag_no_'+this.panel_id+'_'+this.panel_item_id+'_'+this.prev_id);
            var new_ids_arr = Array();
            var new_attribs_arr = Array();
            for(var i=0;i<ids.length;i++) {
               if(this.prev_id==ids[i]) {
                  new_ids_arr.push(id);
                  new_attribs_arr.push(id+'^'+nm);
               } else {
                  new_ids_arr.push(ids[i]);
                  new_attribs_arr.push(attribs[i]);
               }
            }
            ditem.setAttribute('id','diag_no_'+this.panel_id+'_'+this.panel_item_id+'_'+id);
            var newval = new_ids_arr.join('|');
            var newattrib = new_attribs_arr.join('|');
         } else {
            var ditem = dc.appendChild(_dce('div'));
            ditem.setAttribute('class','diagitem');
            ditem.setAttribute('id','diag_no_'+this.panel_id+'_'+this.panel_item_id+'_'+id);
            var newval  = prev+'|'+id;
            if(newval.substring(0,1)=='|') newval = newval.substring(1);
            var newattrib = _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value + '|' + id + '^' + nm;
            if(newattrib.substring(0,1)=='|') newattrib = newattrib.substring(1);
         }
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value = newattrib;
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qicd10edit(\''+id+'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'
                         + '<span class=\"code\">'+id+'</span>&nbsp;'
                         + '<span style=\"color:#888;\">Sekunder</span>';
         dc.style.display = '';
         this._showResult(false);
         if(dc.firstChild) dc.firstChild.lastChild.innerHTML = 'Primer';
      };
      d._send_query = pnlejx_app_searchICD10;
      _make_ajax(d);
   }
}

function qicd10edit(id,panel_id,panel_item_id,d,e) {
   if(edit_ditem&&!d.ditem) {
      _destroy(edit_ditem);
      edit_ditem.d.ditem = null;
   }
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      
      var ids = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id).value.split('|');;
      level_no = 0;
      for(var i=0;i<ids.length;i++) {
         level_no++;
         if(ids[i]==id) break;
      }
      
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="text-align:center;padding:1em;padding-left:0;">'
                            + '<table class=\"invisible\" style=\"\"><tbody><tr>'
                            + '<td><input id=\"qsubicd10\" type=\"text\" onkeypress=\"qicd10press(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);\" class=\"searchBox\" placeholder=\"Substitusi\"/></td>'
                            + '<td style=\"text-align:right\">&nbsp;'
                            + '<input type="button" value="Hapus" onclick="qicd10dodelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>&nbsp;'
                            + '<input type="button" value="Set Primer" onclick="qicd10setprimary(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);" style="'+(level_no>1?'':'display:none;')+'"/>'
                            + '<td/></tr></tbody></table>'
                            + '</div>';
      edit_ditem = d.ditem.del;
      edit_ditem.d = d;
      _dsa(_gel('qsubicd10'));
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qicd10setprimary(id,panel_id,panel_item_id,d,e) {
   if(_gel('grouper_result')) $('#grouper_result').fadeOut();
   _destroy(edit_ditem);
   edit_ditem.d.ditem = null;
   var dc = _gel('qicd10container_'+panel_id+'_'+panel_item_id);
   if(dc.firstChild) dc.firstChild.lastChild.innerHTML = 'Sekunder';
   var ditem = _gel('diag_no_'+panel_id+'_'+panel_item_id+'_'+id);
   _destroy(ditem.del);
   ditem.lastChild.innerHTML = 'Primer';
   dc.insertBefore(ditem,dc.firstChild);
   
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var attribs = _gel('qattrib_'+panel_id+'_'+panel_item_id).value.split('|');
   var newval = '';
   var new_ids_arr = Array();
   var new_attribs_arr = Array();
   var del_primary = false;
   var xattrib = '';
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         new_ids_arr.push(ids[i]);
         new_attribs_arr.push(attribs[i]);
      } else {
         xattrib = attribs[i];
      }
   }
   
   new_ids_arr.unshift(id);
   new_attribs_arr.unshift(xattrib);
   
   q.value = new_ids_arr.join('|');
   attribs.value = new_attribs_arr.join('|');
   
}

function qicd10canceledit(id,panel_id,panel_item_id,d,e) {
   var ditem = _gel('diag_no_'+panel_id+'_'+panel_item_id+'_'+id);
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
   edit_ditem = null;
}

function qicd10dodelete(id,panel_id,panel_item_id,d,e) {
   if(_gel('grouper_result')) $('#grouper_result').fadeOut();
   var ditem = _gel('diag_no_'+panel_id+'_'+panel_item_id+'_'+id);
   _destroy(ditem);
   edit_ditem = null;
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var attribs = _gel('qattrib_'+panel_id+'_'+panel_item_id).value.split('|');
   var newval = '';
   var new_ids_arr = Array();
   var new_attribs_arr = Array();
   var del_primary = false;
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         new_ids_arr.push(ids[i]);
         new_attribs_arr.push(attribs[i]);
      }
   }
   var newval = new_ids_arr.join('|');
   q.value = newval;
   _gel('qattrib_'+panel_id+'_'+panel_item_id).value = new_attribs_arr.join('|');
   var dc = _gel('qicd10container_'+panel_id+'_'+panel_item_id);
   if(dc.firstChild) dc.firstChild.lastChild.innerHTML = 'Primer';
}

//// end icd10

/// qicd9proc begin

function qicd9procpress(prev_id,panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      if(prev_id=='') {
         d._align='right';
      } else {
         d._align='left';
      }
      d.prev_id = prev_id;
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         if(_gel('grouper_result')) $('#grouper_result').fadeOut();
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var prevattrib = _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value;
         var single = _gel('qsingle_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         var attribs = prevattrib.split('|');
         if(single==1&&ids[0]!='') {
            this._showResult(false);
            alert('Please enter 1 diagnosis only');
            return;
         }
         if(in_array(id,ids)) {
            this._showResult(false);
            return;
         }
         
         var dc = _gel('qicd9proccontainer_'+this.panel_id+'_'+this.panel_item_id);
         if(this.prev_id!='') {
            var ditem = _gel('proc_no_'+this.panel_id+'_'+this.panel_item_id+'_'+this.prev_id);
            var new_ids_arr = Array();
            var new_attribs_arr = Array();
            for(var i=0;i<ids.length;i++) {
               if(this.prev_id==ids[i]) {
                  new_ids_arr.push(id);
                  new_attribs_arr.push(id+'^'+nm);
               } else {
                  new_ids_arr.push(ids[i]);
                  new_attribs_arr.push(attribs[i]);
               }
            }
            ditem.setAttribute('id','proc_no_'+this.panel_id+'_'+this.panel_item_id+'_'+id);
            var newval = new_ids_arr.join('|');
            var newattrib = new_attribs_arr.join('|');
         } else {
            var ditem = dc.appendChild(_dce('div'));
            ditem.setAttribute('class','diagitem');
            ditem.setAttribute('id','proc_no_'+this.panel_id+'_'+this.panel_item_id+'_'+id);
            var newval  = prev+'|'+id;
            if(newval.substring(0,1)=='|') newval = newval.substring(1);
            var newattrib = _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value + '|' + id + '^' + nm;
            if(newattrib.substring(0,1)=='|') newattrib = newattrib.substring(1);
         }
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         _gel('qattrib_'+this.panel_id+'_'+this.panel_item_id).value = newattrib;
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qicd9procedit(\''+id+'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'
                         + '<span class=\"code\">'+id+'</span>';
         dc.style.display = '';
         this._showResult(false);
      };
      d._send_query = pnlejx_app_searchICD9Proc;
      _make_ajax(d);
   }
}


function qicd9procedit(id,panel_id,panel_item_id,d,e) {
   if(edit_ditem&&!d.ditem) {
      _destroy(edit_ditem);
      edit_ditem.d.ditem = null;
   }
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="text-align:center;padding:1em;padding-left:0;">'
                            + '<table class=\"invisible\" style=\"\"><tbody><tr>'
                            + '<td><input id=\"qsubicd9proc\" type=\"text\" onkeypress=\"qicd9procpress(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);\" class=\"searchBox\" placeholder=\"Substitusi\"/></td>'
                            + '<td style=\"text-align:right\">&nbsp;'
                            + '<input type="button" value="Hapus" onclick="qicd9procdodelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '<td/></tr></tbody></table>'
                            + '</div>';
      edit_ditem = d.ditem.del;
      edit_ditem.d = d;
      _dsa(_gel('qsubicd9proc'));
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qicd9proccanceledit(id,panel_id,panel_item_id,d,e) {
   var ditem = _gel('diag_no_'+panel_id+'_'+panel_item_id+'_'+id);
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
   edit_ditem = null;
}

function qicd9procdodelete(id,panel_id,panel_item_id,d,e) {
   if(_gel('grouper_result')) $('#grouper_result').fadeOut();
   var ditem = _gel('proc_no_'+panel_id+'_'+panel_item_id+'_'+id);
   _destroy(ditem);
   edit_ditem = null;
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var attribs = _gel('qattrib_'+panel_id+'_'+panel_item_id).value.split('|');
   var newval = '';
   var new_ids_arr = Array();
   var new_attribs_arr = Array();
   var del_primary = false;
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         new_ids_arr.push(ids[i]);
         new_attribs_arr.push(attribs[i]);
      }
   }
   var newval = new_ids_arr.join('|');
   q.value = newval;
   _gel('qattrib_'+panel_id+'_'+panel_item_id).value = new_attribs_arr.join('|');
}

//// end icd9proc

function qicdomorfodelete(id,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">'
                            + '<input type="button" value="Delete" class="btnpanel" onclick="qicdomorfododelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '&nbsp;<input type="button" value="Cancel" class="btnpanel" onclick="qicdomorfocanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '</div>';
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qicdomorfocanceldelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
}

function qicdomorfoconfirmdelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   ditem.oldHTML = ditem.del.innerHTML;
   ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">Anda akan menghapus item ini?<br/>'
                       + '<input type="button" value="Ya (hapus)" class="btnpanel" onclick="qicdomorfododelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '&nbsp;<input type="button" value="Batal" class="btnpanel" onclick="qicdomorfocanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '</div>';
}

function qicdomorfododelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem);
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var newval = '';
   var new_ids_arr = Array();
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         new_ids_arr.push(ids[i]);
      }
   }
   var newval = new_ids_arr.join('|');
   q.value = newval;
}

/// ICD-O MorfOgraphy
function qicdomorfopress(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      d._align='left';
      d.topo_cd = topo_cd;
      d.morfo_cd = morfo_cd;
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var single = _gel('qsingle_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         
         var xid = topo_cd+'#'+id;
         if(in_array(ids,xid)) {
            this._showResult(false);
            return;
         }

         var oldid = topo_cd+'#'+morfo_cd;

         var index = ids.indexOf(oldid);
         ids[index] = xid; /// update the array

         var newval  = ids.join('|');
         if(newval.substring(0,1)=='|') newval = newval.substring(1);
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         
         var dc = _gel('qicdomorfocontainer_'+this.panel_id+'_'+this.panel_item_id);
         var ditem = this.ditem;
         var d = ditem.d;
         ditem.morfod.innerHTML = nm;
         ditem.morfod.nextSibling.innerHTML = id;
         ditem.morfod.nextSibling.style.display = '';
         this._showResult(false);
         _destroy(ditem.morfoeditor);
         d.ditem = null;

      };
      d._send_query = pnlejx_app_searchICDOMorfo;
      _make_ajax(d);
   }
}

// ICD-O Topo
function qicdotopopress(panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      d._align='right';
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var single = _gel('qsingle_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         if(single==1&&ids[0]!='') {
            this._showResult(false);
            alert('Please enter 1 diagnosis only');
            return;
         }
         
         var newval  = prev+'|'+id+'#';
         if(newval.substring(0,1)=='|') newval = newval.substring(1);
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         
         var dc = _gel('qicdotopocontainer_'+this.panel_id+'_'+this.panel_item_id);
         var ditem = dc.appendChild(_dce('div'));
         ditem.setAttribute('class','diagitem');
         var morfo_span_id = uniqid();
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qicdotopodelete(\''+id+'\',\'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'+'<span class=\"code\">'+id+'</span>'
                         + '&nbsp;(&nbsp;'
                         + '<span id=\"'+morfo_span_id+'\" class=\"xlnk\" onclick=\"qicdoeditmorfo(\''+id+'\',\'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">empty morfology</span>'
                         + '<span style=\"display:none;\" class=\"code2\"></span>'
                         + '&nbsp;)&nbsp;'
         dc.style.display = '';
         this._showResult(false);
         qicdoeditmorfo(id,'',this.panel_id,this.panel_item_id,_gel(morfo_span_id),null);
      };
      d._send_query = pnlejx_app_searchICDOTopo;
      _make_ajax(d);
   }
}

function qicdoeditmorfo(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.morfod = d;
      d.ditem.morfoeditor = d.ditem.appendChild(_dce('div'));
      d.ditem.morfoeditor.setAttribute('style','margin-top:5px;');
      d.ditem.morfoeditor.innerHTML = '<div style="padding:5px;text-align:left;">'
                                   + '<input style=\"width:200px;\" placeholder=\"Search Morphology\" type=\"text\" class=\"searchBox\" id=\"qmorfo\" onkeypress=\"qicdomorfopress(\''+topo_cd+'\',\''+morfo_cd+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);\"/>'
                                   + '</div>';
      var qmorfo = _gel('qmorfo');
      qmorfo.ditem = d.ditem;
      _dsa(_gel('qmorfo'));
   } else {
      _destroy(d.ditem.morfoeditor);
      d.ditem = null;
   }

}

function qicdotopodelete(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:0.5em;border-radius:0.5em;text-align:center;width:400px;">'
                            + '<input type="button" value="Delete" class="btnpanel" onclick="qicdotopododelete(\''+topo_cd+'\',\''+morfo_cd+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '&nbsp;<input type="button" value="Cancel" class="btnpanel" onclick="qicdotopocanceldelete(\''+topo_cd+'\',\''+morfo_cd+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '</div>';
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qicdotopocanceldelete(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
}

function qicdotopoconfirmdelete(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   ditem.oldHTML = ditem.del.innerHTML;
   ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">Anda akan menghapus item ini?<br/>'
                       + '<input type="button" value="Ya (hapus)" class="btnpanel" onclick="qicdotopododelete(\''+topo_cd+'\',\''+morfo_cd+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '&nbsp;<input type="button" value="Batal" class="btnpanel" onclick="qicdotopocanceldelete(\''+topo_cd+'\',\''+morfo_cd+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '</div>';
}

function qicdotopododelete(topo_cd,morfo_cd,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem);
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var xid = topo_cd+'#'+morfo_cd;
   var index = ids.indexOf(xid);
   ids.splice(index,1);
   var newval = ids.join('|');
   q.value = newval;
}



function qnandapress(panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      d._align='left';
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         if(in_array(ids,id)) {
            this._showResult(false);
            return;
         }
         
         var newval  = prev+'|'+id;
         if(newval.substring(0,1)=='|') newval = newval.substring(1);
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         
         var dc = _gel('qnandacontainer_'+this.panel_id+'_'+this.panel_item_id);
         var ditem = dc.appendChild(_dce('div'));
         ditem.setAttribute('class','diagitem');
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qnandadelete(\''+id+'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'+'<span class=\"code\">'+id+'</span>';
         dc.style.display = '';
         this._showResult(false);
      };
      d._send_query = pnlejx_app_searchNANDA;
      _make_ajax(d);
   }
}

function qnandadelete(id,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">'
                            + '<input type="button" value="Hapus" class="btnpanel" onclick="qnandaconfirmdelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '&nbsp;<input type="button" value="Ok" class="btnpanel" onclick="qnandacanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '</div>';
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qnandacanceldelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
}

function qnandaconfirmdelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   ditem.oldHTML = ditem.del.innerHTML;
   ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">Anda akan menghapus item ini?<br/>'
                       + '<input type="button" value="Ya (hapus)" class="btnpanel" onclick="qnandadodelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '&nbsp;<input type="button" value="Batal" class="btnpanel" onclick="qnandacanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '</div>';
}

function qnandadodelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem);
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var newval = '';
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         ids.splice(i,1);
      }
   }
   var newval = ids.join('|');
   q.value = newval;
}


function qnocpress(panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      d._align='left';
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         if(in_array(ids,id)) {
            this._showResult(false);
            return;
         }
         
         var newval  = prev+'|'+id;
         if(newval.substring(0,1)=='|') newval = newval.substring(1);
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         
         var dc = _gel('qnoccontainer_'+this.panel_id+'_'+this.panel_item_id);
         var ditem = dc.appendChild(_dce('div'));
         ditem.setAttribute('class','diagitem');
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qnocdelete(\''+id+'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'+'<span class=\"code\">'+id+'</span>';
         dc.style.display = '';
         this._showResult(false);
      };
      d._send_query = pnlejx_app_searchNOC;
      _make_ajax(d);
   }
}

function qnocdelete(id,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">'
                            + '<input type="button" value="Hapus" class="btnpanel" onclick="qnocconfirmdelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '&nbsp;<input type="button" value="Ok" class="btnpanel" onclick="qnoccanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '</div>';
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qnoccanceldelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
}

function qnocconfirmdelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   ditem.oldHTML = ditem.del.innerHTML;
   ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">Anda akan menghapus item ini?<br/>'
                       + '<input type="button" value="Ya (hapus)" class="btnpanel" onclick="qnocdodelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '&nbsp;<input type="button" value="Batal" class="btnpanel" onclick="qnoccanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '</div>';
}

function qnocdodelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem);
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var newval = '';
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         ids.splice(i,1);
      }
   }
   var newval = ids.join('|');
   q.value = newval;
}


function qdrugallergypress(panel_id,panel_item_id,d,e) {
   if(!d._send_query) {
      d._align='right';
      d.panel_id = panel_id;
      d.panel_item_id = panel_item_id;
      d._onselect=function(id,nm) {
         var prev = _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value;
         var ids = prev.split('|');
         if(in_array(ids,id)) {
            this._showResult(false);
            return;
         }
         
         var newval  = prev+'|'+id;
         if(newval.substring(0,1)=='|') newval = newval.substring(1);
         _gel('qpanelvalue_'+this.panel_id+'_'+this.panel_item_id).value = newval;
         
         var dc = _gel('qdrugallergycontainer_'+this.panel_id+'_'+this.panel_item_id);
         var ditem = dc.appendChild(_dce('div'));
         ditem.setAttribute('class','diagitem');
         ditem.innerHTML = '<span class=\"xlnk\" onclick=\"qdrugallergydelete(\''+id+'\',\''+this.panel_id+'\',\''+this.panel_item_id+'\',this,event);\">'+nm+'</span>'+'<span class=\"code\">'+id+'</span>';
         dc.style.display = '';
         this._showResult(false);
      };
      d._send_query = pnlejx_app_searchDrugAllergy;
      _make_ajax(d);
   }
}

function qdrugallergydelete(id,panel_id,panel_item_id,d,e) {
   if(!d.ditem) {
      d.ditem = d.parentNode;
      d.ditem.d = d;
      d.ditem.del = d.ditem.appendChild(_dce('div'));
      d.ditem.del.setAttribute('style','margin-top:5px;');
      d.ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">'
                            + '<input type="button" value="Hapus" class="btnpanel" onclick="qdrugallergyconfirmdelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '&nbsp;<input type="button" value="Ok" class="btnpanel" onclick="qdrugallergycanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                            + '</div>';
   } else {
      _destroy(d.ditem.del);
      d.ditem = null;
   }
}

function qdrugallergycanceldelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem.del);
   ditem.d.ditem = null;
   ditem.del = null;
}

function qdrugallergyconfirmdelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   ditem.oldHTML = ditem.del.innerHTML;
   ditem.del.innerHTML = '<div style="background-color:#ffcccc;padding:5px;text-align:center;">Anda akan menghapus item ini?<br/>'
                       + '<input type="button" value="Ya (hapus)" class="btnpanel" onclick="qdrugallergydodelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '&nbsp;<input type="button" value="Batal" class="btnpanel" onclick="qdrugallergycanceldelete(\''+id+'\',\''+panel_id+'\',\''+panel_item_id+'\',this,event);"/>'
                       + '</div>';
}

function qdrugallergydodelete(id,panel_id,panel_item_id,d,e) {
   var ditem = d.parentNode.parentNode.parentNode;
   _destroy(ditem);
   var q = _gel('qpanelvalue_'+panel_id+'_'+panel_item_id);
   var val = q.value;
   var ids = val.split('|');
   var newval = '';
   for(var i=0;i<ids.length;i++) {
      if(ids[i]!=id) {
         ids.splice(i,1);
      }
   }
   var newval = ids.join('|');
   q.value = newval;
}

    
function selectElementContents(el) {
   var body = document.body, range, sel;
   if (document.createRange && window.getSelection) {
      range = document.createRange();
      sel = window.getSelection();
      sel.removeAllRanges();
      try {
         range.selectNodeContents(el);
         sel.addRange(range);
      } catch (e) {
         range.selectNode(el);
         sel.addRange(range);
      }
   } else if (body.createTextRange) {
      range = body.createTextRange();
      range.moveToElementText(el);
      range.select();
   }
}

function do_printChoice(id,t) {
   var d = _gel(id);
   var param = '';
   if(d) {
      for(var k in d.param) {
         if(d.param.hasOwnProperty(k)) {
            param += k+'='+d.param[k]+'&';
         }
      }
      param += 't='+t+'&u='+uniqid();
      var url = d.url+'?'+encodeURI(param);
      if(t=='xlsx') {
         window.open(url,'_self');
      } else {
         window.open(url,'_blank');
      }
      d.toggleChoice();
   }
}

printChoice = function(d,param) {
   if(!d.dvprint) {
      if(!d.url) d.url = XOCP_SERVER_SUBDIR+'/print/print_engine.php';
      d.param = param;
      d.dvprint = _dce('div');
      d.dvprint.setAttribute('class','dvprint');
      d.dvprint.style.marginLeft = parseInt((d.offsetWidth/2)-102)+'px';
      d.dvprint = d.parentNode.appendChild(d.dvprint);
      d.dvprint.style.left = oX(d)+'px';
      
      if(d.id=='') {
         var prnID = uniqid('prnID');
         d.setAttribute('id',prnID)
      } else {
         var prnID = d.id;
      }
      
      d.dvprint.innerHTML = '<div style="text-align:left;">'
                          + '<img src="'+XOCP_SERVER_SUBDIR+'/images/topmiddle.png" style="position:absolute;margin-top:-19px;margin-left:90px;"/>'
                          + '<table class="invisible" style="width:200px;background-color:rgba(250,250,250,0.9);border:1px solid #555;box-shadow:0 0 3px rgba(0,0,0,0.7) inset;">'
                          + '<colgroup><col width="33%"/><col/><col width="33%"/></colgroup>'
                          + '<tbody><tr>'
                          + '<td class="td_img_print" onclick="do_printChoice(\''+prnID+'\',\'html\');">'
                          + '<img src="'+XOCP_SERVER_SUBDIR+'/images/document-file-html-128.png" class="img_print"/>'
                          + '</td>'
                          + '<td class="td_img_print" onclick="do_printChoice(\''+prnID+'\',\'xlsx\');">'
                          + '<img src="'+XOCP_SERVER_SUBDIR+'/images/document-file-xlsx-128.png" class="img_print"/>'
                          + '</td>'
                          + '<td class="td_img_print" onclick="do_printChoice(\''+prnID+'\',\'pdf\');">'
                          + '<img src="'+XOCP_SERVER_SUBDIR+'/images/document-file-pdf-128.png" class="img_print"/>'
                          + '</td>'
                          + '</tr></tbody></table>'
                          + '</div>';
      
      this.d = d;
      this.dvprint = d.dvprint;
      this.test = 'Hallooo';
      d.printChoice = this;
      d.toggleChoice = function() {
         var tm = 200;
         if(arguments.length>0 && parseInt(arguments[0])>0) {
            tm = parseInt(arguments[0]);
         }
         $(this.dvprint).fadeToggle(tm);
      };
   }
};

function close_fullscreen() {
   _destroy(dvfullscreen.iframe);
   _destroy(dvfullscreen.frame);
   _destroy(dvfullscreen.bg1);
   _destroy(dvfullscreen.bg0);
   _destroy(dvfullscreen);
   dvfullscreen.frame = null;
   dvfullscreen.bg1 = null;
   dvfullscreen.bg0 = null;
   dvfullscreen = null;
}

var dvfullscreen = null;
function setup_fullscreen() {
   if(dvfullscreen) {
      close_fullscreen();
   }
   
   var btn_printserver = '';
   
   var nm = uniqid();
   dvfullscreen = _dce('div');
   dvfullscreen.setAttribute('class','xfullscreen');
   dvfullscreen = document.body.appendChild(dvfullscreen);
   dvfullscreen.bg0 = _dce('div');
   dvfullscreen.bg0.setAttribute('class','xfullscreen_bg0');
   dvfullscreen.bg0 = dvfullscreen.appendChild(dvfullscreen.bg0);
   dvfullscreen.bg1 = _dce('div');
   dvfullscreen.bg1.setAttribute('class','xfullscreen_bg1');
   dvfullscreen.bg1 = dvfullscreen.appendChild(dvfullscreen.bg1);
   
   dvfullscreen.content = _dce('div');
   dvfullscreen.content.setAttribute('class','xfullscreen_bg0');
   dvfullscreen.content = dvfullscreen.appendChild(dvfullscreen.bg1);
   
   dvfullscreen.pn = _dce('div');
   dvfullscreen.pn.setAttribute('class','xfullscreen_pn');
   dvfullscreen.pn = dvfullscreen.bg1.appendChild(dvfullscreen.pn);
   dvfullscreen.pn.onclick=close_fullscreen;
   dvfullscreen.pn.innerHTML = 'close';
}

function init_selectize(parent) {
   var s = parent.getElementsByTagName('select');
   for(var i=0;i<s.length;i++) {
      if(s[i].className=='selectizeitadd') {
         $('#'+s[i].id).selectize({ create:true, sortField:'text' });
      } else {
         if(s[i].style.width=='') {
            s[i].style.width = '250px';
         }
         if(s[i].id=='') s[i].setAttribute('id',uniqid('selectize_id_'));
         $('#'+s[i].id).selectize();
      }
   }
}

function downloadURL(url) {
  var hiddenIFrameID = 'hiddenDownloader';
  var iframe = document.createElement('iframe');
  iframe.id = hiddenIFrameID;
  iframe.style.display = 'none';
  document.body.appendChild(iframe);
  iframe.src = url;
}

function blogimage_click(doc_id,d,e) {
   location.href = XOCP_SERVER_SUBDIR+'/modules/pub/doc_download.php?doc_id='+doc_id;
}
      

