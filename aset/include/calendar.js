<!-- Begin


function calendarClass(id,cb) {
   this.c_dttm = new Date(); // client/browser datetime
   this.s_dttm = new Date(XOCP_DTTM_OBJ.valueOf()); // server datetime
   this.date_type = 'datetime';
   /*
   var dtx = XOCP_CURRENT_DATE.split("-");
   var ttx = XOCP_CURRENT_TIME.split(":");
   this.s_dttm.setFullYear(dtx[0]);
   this.s_dttm.setMonth(dtx[1]-1);
   this.s_dttm.setDate(dtx[2]);
   this.s_dttm.setHours(ttx[0]);
   this.s_dttm.setMinutes(ttx[1]);
   this.s_dttm.setSeconds(ttx[2]);
   */
   this.id = id;
   this.obj = this;
   this.selMonth = null;
   //this.day_of_week = ['M','S','S','R','K','J','S'];
   this.day_of_week = ['S','M','T','W','T','F','S'];
   this.month_of_year = ['January','February','March','April','May','June','July','August','September','October','November','December'];
   this.calendar = new Date();
   this.year = this.calendar.getFullYear();
   this.month = this.calendar.getMonth();
   this.today = this.calendar.getDate();
   this.weekday = this.calendar.getDay();
   this.hours = this.calendar.getHours();
   this.minutes = this.calendar.getMinutes();
   this.seconds = this.calendar.getSeconds();
   this.timer=null;
   this.result='';
   this.sync=true;
   this.notime=false;
   var div = document.createElement('div');
   div.setAttribute('style','margin:0px;z-index:1000;-moz-box-shadow:0px 0px 5px #333;box-shadow:0px 0px 5px #333;border-radius:5px;-moz-border-radius:5px;background-color:#fff;');
   div.setAttribute('id',id);
   this.div = div;
   this.div.obj = this;
   this.callback = cb;
   this.type = 'datetime';
   this.backdate = true;
   this.setDTTM=function(dttmx) {
      if(dttmx=='0000-00-00 00:00:00') {
         return;
      }
      this.sync=false;
      var dttm = dttmx.split(' ');
      var dt,tt;
      var y,m,d,hh,mm,ss;
      y=m=d=hh=mm=ss=null;
      dt = dttm[0].split('-');
      this.setDate(dt[0],dt[1]-1,dt[2]);
      if(dttm[1]&&dttm[1].length>0) {
         tt = dttm[1].split(':');
         hh=parseInt(tt[0],10);
         mm=parseInt(tt[1],10);
         ss=parseInt(tt[2],10);
         this.setTime(tt[0],tt[1],tt[2]);
      }
      this.render();
   };
   
   this.setType=function(t) {
      if(t=='date') {
         this.type = 'date';
      } else {
         this.type = 'datetime';
      }
   };
   
   this.toString=function(t) {
      return sql2string(t,this.toString.arguments[1]);
      var dttm = t.split(' ');
      var dt,tt;
      var y,m,d,hh,mm,ss;
      y=m=d=hh=mm=ss=null;
      dt = dttm[0].split('-');
      y=parseInt(dt[0],10);
      m=parseInt(dt[1],10);
      d=parseInt(dt[2],10);
      var datestr='';
      datestr += d+' '+this.month_of_year[m-1]+' '+y;
      if(this.toString.arguments[1]=='datetime') {
         tt = dttm[1].split(':');
         datestr += ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2);
      } else if(this.toString.arguments[1]=='datetimesec') {
         tt = dttm[1].split(':');
         datestr += ' '+strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2)+':'+strPad(tt[2],'0',2);
      } else if(this.toString.arguments[1]=='time') {
         tt = dttm[1].split(':');
         datestr = strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2);
      } else if(this.toString.arguments[1]=='timesec') {
         tt = dttm[1].split(':');
         datestr = strPad(tt[0],'0',2)+':'+strPad(tt[1],'0',2)+':'+strPad(tt[2],'0',2);
      }
      return datestr;
   };
   
   this.hide=function() {
      _destroy(this.selMonth);
      this.selMonth=null;
      this.div.style.visibility='hidden';
   }
   
   this.setValue=function(tm) {
      this.calendar = new Date(tm);
      this.sync=false;
      this.year = this.calendar.getFullYear();
      this.month = this.calendar.getMonth();
      this.today = this.calendar.getDate();
      this.weekday = this.calendar.getDay();
      this.hours = this.calendar.getHours();
      this.minutes = this.calendar.getMinutes();
      this.seconds = this.calendar.getSeconds();
      this.result = this.year+'-'+parseInt(this.month+1)+'-'+this.today+' '+this.hours+':'+this.minutes+':'+this.seconds;
   };
   
   this.subValue=function(tm) {
      var n = new Date();
      var t = new Date(this.s_dttm.valueOf()+(n.valueOf() - XOCP_CLIENT_DTTM.valueOf())-tm);
      this.setValue(t);
   };
   
   this.getResult=function() {
      if(this.sync) {
         var n = new Date();
         var t = new Date(this.s_dttm.valueOf()+(n.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
         this.result = t.getFullYear()+'-'+parseInt(t.getMonth()+1)+'-'+t.getDate()+' '+t.getHours()+':'+t.getMinutes()+':'+t.getSeconds();
      }
      return this.result;
   }
   
   this.getDate=function() {
      var tt = this.result.split(' ');
      return tt[0];
   }
   
   this.doSync=function(t) {
      if(t) {
         this.sync=true;
      } else {
         this.sync=false;
      }
      this.render();
   }
   
   this.render = function() {
      _destroy(this.selMonth);
      this.selMonth = null;
      var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
      var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
      var cal;    // Used for printing
      if(this.sync) {
         var n = new Date();
         this.calendar = new Date(this.s_dttm.valueOf()+(n.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
      }
      this.year = this.calendar.getFullYear();
      this.month = this.calendar.getMonth();
      this.today = this.calendar.getDate();
      this.weekday = this.calendar.getDay();
      this.hours = this.calendar.getHours();
      this.minutes = this.calendar.getMinutes();
      this.seconds = this.calendar.getSeconds();
      var tmpcal = new Date();
      
      cal = '<table style="width:160px;" border="1" class="cal" cellspacing="0"><tbody><tr>';
      cal += '<td class="calarrow" style="text-align:right;" colspan="1" style="cursor:pointer;" onmousedown="calAct(\''+this.id+'\',\'prevyear\');"><img src="'+XOCP_SERVER_SUBDIR+'/images/prev.gif" /> <img src="'+XOCP_SERVER_SUBDIR+'/images/prev.gif" /></td>';
      cal += '<td class="calx" style="text-align:center;" colspan="5"><input onmousedown="return calSelYear(\''+this.id+'\');" type="text" id="'+this.id+'_year" value="' + this.year + '" size="6" class="inputcal" onkeydown="calYearKey(\''+this.id+'\',this,event);" onblur="calAct(\''+this.id+'\',\'setyear\',\'enter\');" \/></td>';
      cal += '<td class="calarrow" style="text-align:left;" colspan="1" style="cursor:pointer;" onmousedown="calAct(\''+this.id+'\',\'nextyear\');"><img src="'+XOCP_SERVER_SUBDIR+'/images/next.gif" /> <img src="'+XOCP_SERVER_SUBDIR+'/images/next.gif" /></td></tr>';
      cal += '<tr><td class="calarrow" style="text-align:right;" colspan="1" style="cursor:pointer;" onmousedown="calAct(\''+this.id+'\',\'prevmonth\');"><img src="'+XOCP_SERVER_SUBDIR+'/images/prev.gif" /></td>';
      cal += '<td class="calx" style="text-align:center;" colspan="5"><div style="width:80px;cursor:pointer;margin:auto;" onmousedown="return calSelMonth(\''+this.id+'\',this,event);" class="inputcal">'+this.month_of_year[this.month]+'</div></td>';
      cal += '<td class="calarrow" style="text-align:left;" colspan="1" style="cursor:pointer;" onmousedown="calAct(\''+this.id+'\',\'nextmonth\');"><img src="'+XOCP_SERVER_SUBDIR+'/images/next.gif" /></td></tr>';
      
      cal += '<tr>';
      
      // LOOPS FOR EACH DAY OF WEEK
      for(index=0; index < DAYS_OF_WEEK; index++) {
         // BOLD TODAY'S DAY OF WEEK
         var st = index==0?' style="background-color:#dd6666;"':'';
         cal += '<td class="cweek"'+st+'>' + this.day_of_week[index] + '</td>';
      }
      
      cal += '</tr>';
      
      cal += '<tr>';
      
      // FILL IN BLANK GAPS UNTIL THE FIRST DAY OF THE MONTH
      tmpcal.setDate(1);    // Start the calendar day at '1'
      tmpcal.setMonth(this.month);    // Start the calendar month at now
      tmpcal.setYear(this.year);
      
      var firstday = tmpcal.getDay();
      tmpcal.setDate(tmpcal.getDate()-firstday);
      var ld = tmpcal.getDate();
      var index;
      var day1=tmpcal.getDay();
      for(index=0; index < firstday; index++) {
         cal += '<td class="lmon" '+(day1==0?'style="border-left:0px;"':'')+'>'+ld+'</td>';
         ld++;
         day1++;
      }
      
      tmpcal.setDate(1);    // Start the calendar day at '1'
      tmpcal.setMonth(this.month);    // Start the calendar month at now
      tmpcal.setYear(this.year);
      //cal += '</tr>';
      
      
      var ttlcell;
      ttlcell=Math.ceil((index+31)/7) * 7 - index;
      // LOOPS FOR EACH DAY IN CALENDAR
      var week_day = 0;
      for(var index=0; index < ttlcell; index++) {
         // RETURNS THE NEXT DAY TO PRINT
         if(day1 == (DAYS_OF_WEEK)) {
            cal += '</tr>';
         }
         if(week_day==(DAYS_OF_WEEK-1)) {
            cal += '</tr>';
         }
         week_day=tmpcal.getDay();
         var day  = tmpcal.getDate();
         
         
         
         // START NEW ROW FOR FIRST DAY OF WEEK
         if(week_day == 0) {
            cal += '<tr>';
         }
         if(week_day != DAYS_OF_WEEK) {
            // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
            if( tmpcal.getDate() > index ) {
               // HIGHLIGHT TODAY'S DATE
               if( this.today==tmpcal.getDate()) {
                  cal += '<td class="cdate_hilite" '+(week_day==0?'style="border-left:0px;"':'')+' onmousedown="calAct(\''+this.id+'\',\''+day+'\')">' + day + '</td>';
               } else {
                  // PRINTS OTHER DAY
                  cal += '<td class="cdate" '+(week_day==0?'style="border-left:0px;"':'')+' onmousedown="calAct(\''+this.id+'\',\''+day+'\')">' + day + '</td>';
               }
            } else {
               // PRINT DAY OF NEXT MONTH
               cal += '<td class="lmon" '+(week_day==0?'style="border-left:0px;"':'')+'>' + day + '</td>';
            }
         }
         // END ROW FOR LAST DAY OF WEEK
         // INCREMENTS UNTIL END OF THE MONTH
         tmpcal.setDate(tmpcal.getDate()+1);
      }// end for loop
      
      cal += '</tr>';
      
      cal += '<tr><td class="calx" style="text-align:center;" colspan="7">';
      
      if(this.date_type=='date') {
         cal += '<input type="hidden" value="'+strPad(this.hours,'0',2)+':'+strPad(this.minutes,'0',2)+':'+strPad(this.seconds,'0',2)+'"';
         cal += ' id="'+this.id+'_time"/>';
      } else {
         cal += 'Jam: ';
         cal += '<input ';
         cal += this.sync?'value="-"':'value="'+strPad(this.hours,'0',2)+':'+strPad(this.minutes,'0',2)+':'+strPad(this.seconds,'0',2)+'"';
         cal += ' onkeydown="calTimeKey(\''+this.id+'\',this,event);" ';
         cal += ' onmousedown="return calSelectTime(\''+this.id+'\',this,event);" ';
         cal += ' id="'+this.id+'_time" type="text" size="8" maxlength="8" class="inputcal" />&#160;&#160;';
      }
      
      
      cal += '<span id="calsync" onmousedown="return calSync(\''+this.id+'\');" class="';
      cal += this.sync?'sync_on':'sync_off';
      cal += '">Sync</span>'; /// [<span class="ylnk" onclick="return calZero(\''+this.id+'\');">x</span>]';
      
      cal += '</td></tr>';
      
      
      cal += '</tbody></table>';
      try {
         this.div.innerHTML = cal;
      } catch(e) {
         alert(e);
      }
      _destroy(this.selMonth);
   };
   
   var calTimer = new ctimer('calAct("'+this.id+'","settime")',350);
   
   this.setTime=function() {
      this.sync=false;
      this.calendar.setHours(this.setTime.arguments[0]);
      this.calendar.setMinutes(this.setTime.arguments[1]);
      this.calendar.setSeconds(this.setTime.arguments[2]);
      this.hours = this.calendar.getHours();
      this.minutes = this.calendar.getMinutes();
      this.seconds = this.calendar.getSeconds();
      this.result = this.year+'-'+parseInt(this.month+1)+'-'+this.today+' '+this.hours+':'+this.minutes+':'+this.seconds;
   }
   
   this.tryDate=function(year,month,date) {
      var cd = new Date();
      cd.setYear(year);
      cd.setMonth(month);
      cd.setDate(date);
      return cd;
   }
   
   this.setDate=function(year,month,date) {
      if(this.sync) {
         var n = new Date();
         this.calendar = new Date(this.s_dttm.valueOf()+(n.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
         this.sync=false;
      }
      this.calendar.setYear(year);
      this.calendar.setDate(date);
      this.calendar.setMonth(month);
      this.calendar.setDate(date);
      
      this.year = this.calendar.getFullYear();
      this.month = this.calendar.getMonth();
      this.today = this.calendar.getDate();
      this.weekday = this.calendar.getDay();
      this.result = this.year+'-'+parseInt(this.month+1)+'-'+this.today+' '+this.hours+':'+this.minutes+':'+this.seconds;
   };
   
   this.div.ondoubleclick=function() {
   };
   
   
   var atime = XOCP_CURRENT_TIME.split(":");
   this.setTime(atime[0],atime[1],atime[2]);
   var adate = XOCP_CURRENT_DATE.split('-');
   this.setDate(adate[0],adate[1]-1,adate[2]);
   this.sync=true;
   this.render();
}

function calSync(idc) {
   var c=_gel(idc);
   if(c.obj.sync==true) {
      _gel('calsync').setAttribute('class','sync_off');
      var t = c.obj.getResult().split(" ");
      var h = t[1].split(':');
      _gel(idc+'_time').value = strPad(h[0],'0',2)+':'+strPad(h[1],'0',2)+':'+strPad(h[2],'0',2);
      c.obj.sync=false;
   } else {
      _gel('calsync').setAttribute('class','sync_on');
      _gel(idc+'_time').value = '-';
      c.obj.sync=true;
      c.obj.render();

   }
   if(c.obj.callback) {
      c.obj.callback(c.obj.getResult());
   }
   if(c.obj.notime) {
      c.obj.hide();
   }
   return false;
}

function calZero(idc) {
   var c=_gel(idc);
   if(c.obj.callback_zero) {
      c.obj.callback_zero();
   }
   c.obj.hide();
   return false;
}

function calTimeKey(id,d,e) {
   e.cancelBubble=true;
   var obj = _gel(id);
   var key = getkeyc(e);
   switch(key) {
      case 13:
         calAct(id,"settime","enter");
         obj.blur();
         return false;
         break;
      default:
         window.clearTimeout(obj.timer);
         obj.timer = window.setTimeout('calAct("'+id+'","settime")',5000);
         break;
   }
   return false;
}

function calSelectTime(id,d,e) {
   var inp = _gel(id+'_time');
   _dsa(inp);
   return false;
}

function calSelMonth(id,d,e) {
   var cal = _gel(id);
   
   if(!cal.obj.selMonth) {
      cal.obj.selMonth=document.createElement('div');
      cal.obj.selMonth.setAttribute('style','text-align:left;position:absolute;left:0px;top:0px;visibility:hidden;background-color:#ffffff;border:1px outset #555555;');
      cal.obj.selMonth.setAttribute('id',id+'_selmonth');
      var mtxt='';
      for(var i=0;i<cal.obj.month_of_year.length;i++) {
         mtxt += '<div class="calselmonth" onclick="calAct(\''+id+'\',\'setmonth\',\''+i+'\');">'+cal.obj.month_of_year[i]+'</div>';
      }
      cal.obj.selMonth.innerHTML = mtxt;
      cal.obj.selMonth=cal.appendChild(cal.obj.selMonth);
   }
   
   if(cal.obj.selMonth.style.visibility=='hidden') {
      cal.obj.selMonth.style.left = (d.offsetLeft+d.parentNode.offsetLeft)+'px';
      cal.obj.selMonth.style.top = (d.offsetHeight+d.parentNode.offsetHeight+4)+'px';
      cal.obj.selMonth.style.width = '80px';
      cal.obj.selMonth.style.visibility='visible';
   } else {
      cal.obj.selMonth.style.visibility='hidden';
   }
   return false;
}

function calSelYear(id) {
   var yid = _gel(id+'_year');
   if(yid.select) {
      yid.select();
   }
   return false;
}

function calYearKey(id,d,e) {
   e.cancelBubble=true;
   var obj = _gel(id);
   var key = getkeyc(e);
   switch(key) {
      case 13:
         calAct(id,"setyear","enter");
         return false;
         break;
      default:
         break;
   }
   return false;
}

function calAct(id,cmd) {
   var cal = _gel(id);
   if(cal) {
      switch(cmd) {
         case 'nextyear' :
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cal.obj.year+1,cal.obj.calendar.getMonth(),cal.obj.today);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),cd.getDate());
               } else {
                  cal.obj.setDate(cal.obj.year+1,cal.obj.calendar.getMonth(),cal.obj.today);
               }
            } else {
               cal.obj.setDate(cal.obj.year+1,cal.obj.calendar.getMonth(),cal.obj.today);
            }
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            break;
         case 'prevyear' :
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cal.obj.year-1,cal.obj.calendar.getMonth(),cal.obj.today);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),cd.getDate());
               } else {
                  cal.obj.setDate(cal.obj.year-1,cal.obj.calendar.getMonth(),cal.obj.today);
               }
            } else {
               cal.obj.setDate(cal.obj.year-1,cal.obj.calendar.getMonth(),cal.obj.today);
            }
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            break;
         case 'nextmonth' :
            var m = parseInt(cal.obj.calendar.getMonth())+1;
            var max_date = 31;
            switch(m) {
               case 1:
                  max_date = 28;
                  break;
               case 3:
               case 5:
               case 8:
               case 10:
                  max_date = 30;
                  break;
               default:
                  break;
            }
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cal.obj.year,m,cal.obj.today);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),Math.min(cd.getDate(),max_date));
               } else {
                  cal.obj.setDate(cal.obj.year,m,Math.min(cal.obj.today,max_date));
               }
            } else {
               cal.obj.setDate(cal.obj.year,m,Math.min(cal.obj.today,max_date));
            }
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            break;
         case 'prevmonth':
            var cm = cal.obj.calendar.getMonth();
            var cy = cal.obj.year;
            if(cal.obj.calendar.getMonth()==0) {
               cy--;
               cm = 11;
            } else {
               cm--;
            }
            var max_date = 31;
            switch(cm) {
               case 1:
                  max_date = 28;
                  break;
               case 3:
               case 5:
               case 8:
               case 10:
                  max_date = 30;
                  break;
               default:
                  break;
            }
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cy,cm,cal.obj.today);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),Math.min(cd.getDate(),max_date));
               } else {
                  cal.obj.setDate(cy,cm,Math.min(cal.obj.today,max_date));
               }
            } else {
               cal.obj.setDate(cy,cm,Math.min(cal.obj.today,max_date));
            }
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            break;
         case 'settime':
            var i = _gel(id+'_time');
            if(i) {
               var ta = i.value;
               var t=[];
               if(ta.match(/\./)) {
                  t = ta.split(".");
               } else if(ta.match(/\:/)) {
                  t = ta.split(":");
               } else if(ta.length==4 && !isNaN(parseInt(ta))) {
                  t[0] = ta.substring(0,2);
                  t[1] = ta.substring(2,4);
               } else if(ta.length==3 && !isNaN(parseInt(ta))) {
                  t[0] = ta.substring(0,1);
                  t[1] = ta.substring(1,3);
               } else if(ta.length==5 && !isNaN(parseInt(ta))) {
                  t[0] = ta.substring(0,1);
                  t[1] = ta.substring(1,3);
                  t[2] = ta.substring(3,5);
               } else if(ta.length==6 && !isNaN(parseInt(ta))) {
                  t[0] = ta.substring(0,2);
                  t[1] = ta.substring(2,4);
                  t[2] = ta.substring(4,6);
               } else {
                  t[0] = ta;
               }
               var h = isNaN(parseFloat(t[0]))?0:parseFloat(t[0]);
               var m = isNaN(parseFloat(t[1]))?0:parseFloat(t[1]);
               var s = isNaN(parseFloat(t[2]))?0:parseFloat(t[2]);
               var x = m;
               cal.obj.setTime(h,m,s);
               _gel('calsync').setAttribute('class','sync_off');
               cal.obj.callback(cal.obj.result);
               if(calAct.arguments[2]=="enter") {
                  i.value = strPad(cal.obj.hours,'0',2)+':'+strPad(cal.obj.minutes,'0',2)+':'+strPad(cal.obj.seconds,'0',2);
                  //cal.obj.hide();
               }
            }
            break;
         case 'setmonth':
            var m = parseInt(calAct.arguments[2]);
            var max_date = 31;
            switch(m) {
               case 1:
                  max_date = 28;
                  break;
               case 3:
               case 5:
               case 8:
               case 10:
                  max_date = 30;
                  break;
               default:
                  break;
            }
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cal.obj.year,m,cal.obj.today);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),Math.min(cd.getDate(),max_date));
               } else {
                  cal.obj.setDate(cal.obj.year,m,Math.min(cal.obj.today,max_date));
               }
            } else {
               cal.obj.setDate(cal.obj.year,m,Math.min(cal.obj.today,max_date));
            }
            _gel(id+'_selmonth').style.visibility='hidden';
            _gel('calsync').setAttribute('class','sync_off');
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            break;
         case 'setyear':
            var i = _gel(id+'_year');
            if(i) {
               if(calAct.arguments[2]=="enter") {
                  var ta = i.value;
                  var y = 0;
                  if(ta.length>=4 && !isNaN(parseInt(ta))) {
                     y = parseInt(ta);
                  } else if(ta.length==2 && !isNaN(parseInt(ta))) {
                     var cy = parseFloat(cal.obj.s_dttm.getFullYear().toString().substring(0,2));
                     var csy = parseFloat(cal.obj.s_dttm.getFullYear().toString().substring(2,4));
                     y = parseFloat(ta)>csy ? (cy-1)*100+parseFloat(ta) : cy*100+parseFloat(ta);
                  } else if(ta.length==1 && !isNaN(parseInt(ta))) {
                     var cy = cal.obj.s_dttm.getFullYear().toString().substring(0,3);
                     y = parseInt(cy + ta);
                  } else {
                     return false;
                  }
                  if(!cal.obj.backdate) {
                     var nd = new Date();
                     var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
                     var td = cal.obj.tryDate(y,cal.obj.month,cal.obj.today);
                     if(td.valueOf()<cd.valueOf()) {
                        cal.obj.setDate(cd.getFullYear(),cd.getMonth(),cd.getDate());
                     } else {
                        cal.obj.setDate(y,cal.obj.month,cal.obj.today);
                     }
                  } else {
                     cal.obj.setDate(y,cal.obj.month,cal.obj.today);
                  }
                  _gel('calsync').setAttribute('class','sync_off');
                  cal.obj.callback(cal.obj.result);
                  cal.obj.render();
               }
            }
            break;
         default:
            if(!cal.obj.backdate) {
               var nd = new Date();
               var cd = new Date(cal.obj.s_dttm.valueOf()+(nd.valueOf() - XOCP_CLIENT_DTTM.valueOf()));
               var td = cal.obj.tryDate(cal.obj.year,cal.obj.month,cmd);
               if(td.valueOf()<cd.valueOf()) {
                  cal.obj.setDate(cd.getFullYear(),cd.getMonth(),cd.getDate());
               } else {
                  cal.obj.setDate(cal.obj.year,cal.obj.month,cmd);
               }
            } else {
               cal.obj.setDate(cal.obj.year,cal.obj.month,cmd);
            }
            cal.obj.callback(cal.obj.result);
            cal.obj.render();
            if(cal.obj.notime) {
               cal.obj.hide();
            }
            break;
      }
   }
}

function _changedatetime_callback() {

}

function _changedatetime(span_txt_id,input_hidden_id,date_type,notime_arg,nobackdate) {
   
   var notime = false;
   
   if(!_gel(span_txt_id)) {
      alert('Error. Span is not found.');
      return;
   }
   if(!_gel(input_hidden_id)) {
      alert('Error. Input is not found.');
      return;
   }
   
   
   _gel(span_txt_id).input_hidden_id = input_hidden_id;
   _gel(input_hidden_id).span_txt_id = span_txt_id;
   
   switch(date_type) {
      case 'date':
         notime = true;
         break;
      default:
         date_type = 'datetime';
         break;
   }
   
   switch(notime_arg) {
      case true:
         notime = true;
         break;
      default:
         notime = false;
         break;
   }
   
   if(!_gel(span_txt_id).setDT) {
      _gel(span_txt_id).setDT=function(dt) {
         var d = _gel(span_txt_id);
         d.innerHTML = d.obdt.obj.toString(d.obdt.obj.getResult(),date_type);
         _gel(input_hidden_id).value = d.obdt.obj.getResult();
         if(_gel(span_txt_id).callback) {
            _gel(span_txt_id).callback(d.obdt.obj.getResult());
         }
         if(_changedatetime_callback) {
            _changedatetime_callback(span_txt_id,d.obdt.obj.getResult(),d.obdt.style.visibility);
         }
      }
   }
   
   if(!_gel('obdt_'+span_txt_id)) {
      var cal = new calendarClass('obdt_'+span_txt_id,_gel(span_txt_id).setDT);
      cal.notime = notime;
      cal.date_type = date_type;
      cal.render();
      cal.div.style.position = 'absolute';
      cal.div.style.left = '0px';
      cal.div.style.top = '0px';
      cal.div.style.visibility = 'hidden';
      _gel(span_txt_id).obdt=_gel(span_txt_id).parentNode.appendChild(cal.div);
   } else {
      _gel(span_txt_id).obdt = _gel('obdt_'+span_txt_id);
   }
   
   if(_gel(span_txt_id).obdt.style.visibility=='hidden') {
      _gel(span_txt_id).obdt.obj.setDTTM(_gel(input_hidden_id).value);
      _gel(span_txt_id).obdt.style.left = (oX(_gel(span_txt_id)))+'px';
      _gel(span_txt_id).obdt.style.top = (oY(_gel(span_txt_id))+_gel(span_txt_id).offsetHeight)+'px';
      _gel(span_txt_id).obdt.style.visibility='visible';
   } else {
      _gel(span_txt_id).obdt.obj.hide();
   }
   
   if(nobackdate) {
      _gel(span_txt_id).obdt.obj.backdate = false;
   } else {
      _gel(span_txt_id).obdt.obj.backdate = true;
   }
   
   
   
}

//  End -->