// set for gtj
function gregorian_to_jalali(date)
{
    var tmpTr = date.split('/');
    var Y = parseInt(tmpTr[0], 10);
    var D = parseInt(tmpTr[2], 10);
    var m = parseInt(tmpTr[1], 10);
    if (D > Y)
    {
        Y = parseInt(tmpTr[2]);
        D = parseInt(tmpTr[0]);
    }
    tmpTr = gtj(Y, m, D, '');
    tmpTr = tmpTr.replace(/\//g, '/');
    return tmpTr;
}

function gregorian_to_jalali2(date)
{
    var tmpTr = date.split('-');
    var Y = parseInt(tmpTr[0], 10);
    var D = parseInt(tmpTr[2], 10);
    var m = parseInt(tmpTr[1], 10);
    if (D > Y)
    {
        Y = parseInt(tmpTr[2]);
        D = parseInt(tmpTr[0]);
    }
    tmpTr = gtj(Y, m, D, '');
    tmpTr = tmpTr.replace(/\//g, '-');
    return tmpTr;
}

//set for jtg
function jalali_to_gregorian(date)
{
    var tmpTr = date.split('/');
    var Y = parseInt(tmpTr[0], 10);
    var D = parseInt(tmpTr[2], 10);
    var m = parseInt(tmpTr[1], 10);
    if (D > Y)
    {
        Y = parseInt(tmpTr[2]);
        D = parseInt(tmpTr[0]);
    }
    tmpTr = jtg(Y, m, D, '');
    tmpTr = tmpTr.replace(/\//g, '-');
    return tmpTr;
}

//gtj
function gtj(g_y, g_m, g_d, choice) {
    var g_days_in_month = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var j_days_in_month = new Array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    var gy, gm, gd;
    var jy, jm, jd;
    var g_day_no, j_day_no;
    var j_np;
    var i;
    gy = g_y - 1600;
    gm = g_m - 1;
    gd = g_d - 1;
    g_day_no = 365 * gy + Math.floor((gy + 3) / 4) - Math.floor((gy + 99) / 100) + Math.floor((gy + 399) / 400);
    for (i = 0; i < gm; ++i)
        g_day_no += g_days_in_month[i];
    if (gm > 1 && ((gy % 4 == 0 && gy % 100 != 0) || (gy % 400 == 0)))
        ++g_day_no;
    g_day_no += gd;
    j_day_no = g_day_no - 79;
    j_np = Math.floor(j_day_no / 12053);
    j_day_no %= 12053;
    jy = 979 + 33 * j_np + 4 * Math.floor((j_day_no / 1461));
    j_day_no %= 1461;
    if (j_day_no >= 366) {
        jy += Math.floor((j_day_no - 1) / 365);
        j_day_no = (j_day_no - 1) % 365;
    }
    for (i = 0; i < 11 && j_day_no >= j_days_in_month[i]; ++i) {
        j_day_no -= j_days_in_month[i];
    }
    jm = i + 1;
    jd = j_day_no + 1;
    var strjm = new String(jm);
    var strjd = new String(jd);
    if (jm < 10)
        strjm = "0" + jm;
    if (jd < 10)
        strjd = "0" + jd;
    if (choice == 'y' || choice == 'Y')
        return String(jy);
    else if (choice == 'm' || choice == 'M')
        return strjm;
    else if (choice == 'd' || choice == 'D')
        return strjd;
    else
        return String(jy) + '/' + strjm + '/' + strjd;
}

//jtg
function jtg(j_y, j_m, j_d, choice) {
    var g_days_in_month = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var j_days_in_month = new Array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
    var gy, gm, gd;
    var jy, jm, jd;
    var g_day_no, j_day_no;
    var leap;
    var i;
    jy = j_y - 979;
    jm = j_m - 1;
    jd = j_d - 1;
    j_day_no = 365 * jy + Math.floor(jy / 33) * 8 + Math.floor((jy % 33 + 3) / 4);
    for (i = 0; i < jm; ++i)
        j_day_no += j_days_in_month[i];
    j_day_no += jd;
    g_day_no = j_day_no + 79;
    gy = 1600 + 400 * Math.floor((g_day_no) / (146097));
    g_day_no = g_day_no % 146097;
    leap = 1;
    if (g_day_no >= 36525)
    {
        g_day_no--;
        gy += 100 * Math.floor((g_day_no) / (36524));
        g_day_no = g_day_no % 36524;

        if (g_day_no >= 365)
            g_day_no++;
        else
            leap = 0;
    }
    gy += 4 * Math.floor((g_day_no) / (1461));
    g_day_no %= 1461;
    if (g_day_no >= 366) {
        leap = 0;
        g_day_no--;
        gy += Math.floor((g_day_no) / (365));
        g_day_no = g_day_no % 365;
    }
    for (i = 0; g_day_no >= g_days_in_month[i] + (i == 1 && leap); i++)
        g_day_no -= g_days_in_month[i] + (i == 1 && leap);
    gm = i + 1;
    gd = g_day_no + 1;
    var strgm = new String(gm);
    var strgd = new String(gd);
    if (gm < 10)
        strgm = "0" + gm;
    if (gd < 10)
        strgd = "0" + gd;
    if (choice == 'y' || choice == 'Y')
        return String(gy);
    else if (choice == 'm' || choice == 'M')
        return strgm;
    else if (choice == 'd' || choice == 'D')
        return strgd;
    else
        return String(gy) + '/' + strgm + '/' + strgd;
}
