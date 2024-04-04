function year(rok) {
  return ((rok % 4 == 0) && ((rok % 100 != 0) || (rok % 400 == 0)));
}
function printCalendar() {
  data = new Date();

  var rok = data.getYear();
  if (rok < 1000) rok = 2000 + rok - 100;

  var month = data.getMonth() + 1;
  var week = data.getDay();
  var dayinmonth = data.getDate();

  var tempDate = new Date(rok, month - 1, 1);
  var firstday = tempDate.getDay();

  if (week == 0) week = 7;
  if (firstday == 0) firstday = 7;

  switch (month) {
    case 1: monthname = "มกราคม";
      dayinmonth = 31;
      break;
    case 2: monthname = "กุมภาพันธ์";
      dayinmonth = year(rok) ? 29 : 28;
      break;
    case 3: monthname = "มีนาคม";
      dayinmonth = 31;
      break;
    case 4: monthname = "เมษายน";
      dayinmonth = 30;
      break;
    case 5: monthname = "พฤษภาคม";
      dayinmonth = 31;
      break;
    case 6: monthname = "มิถุนายน";
      dayinmonth = 30;
      break;
    case 7: monthname = "กรกฎาคม";
      dayinmonth = 31;
      break;
    case 8: monthname = "สิงหาคม";
      dayinmonth = 31;
      break;
    case 9: monthname = "กันยายน";
      dayinmonth = 30;
      break;
    case 10: monthname = "ตุลาคม";
      dayinmonth = 31;
      break;
    case 11: monthname = "พฤษจิกายน";
      dayinmonth = 30;
      break;
    case 12: monthname = "ธันวาคม";
      dayinmonth = 31;
      break;
  }

  document.write("<TABLE border = 1><TR>");
  document.write("<TD bgcolor='#20d9fa' align='center' colspan='7'>");
  document.write(monthname + " " + rok);
  document.write("</TD></TR><TR>");

  document.write("<TR>");
  document.write("<TD align='center' bgcolor='skyblue'>อา</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>จ</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>อ</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>พ</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>พฤ</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>ศ</TD>");
  document.write("<TD align='center' bgcolor='skyblue'>ส</TD>");
  document.write("</TR>");

  var j = dayinmonth + firstday - 1;

  for (var i = 0; i < j; i++) {
    if (i < firstday - 1) {
      document.write("<TD bgcolor='white'></TD>");
      continue;
    }
    if ((i % 7) == 0) {
      document.write("</TR><TR>");
    }
    if ((i - firstday + 2) == dayinmonth) {
      color = "#2098fa";
    }
    else {
      color = "#f9f9f9";
    }
    document.write("<TD bgcolor='" + color + "' align='center'>");
    document.write(i - firstday + 2);
    document.write("</TD>");
  }
  document.write("</TR></TABLE>");
}