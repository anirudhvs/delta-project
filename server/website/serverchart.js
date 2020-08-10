// new Date(data[0].time_visited.split(" ")[0]).getMonth()

function browserCount(dataforbrowser) {

  let IE = 0,
    Firefox = 0,
    Safari = 0,
    Chrome = 0,
    Edge = 0,
    Opera = 0,
    Handheld = 0;

  for (let i in dataforbrowser) {
    if (dataforbrowser[i].browser == "Internet Explorer") IE += 1;
    else if (dataforbrowser[i].browser == "Firefox") Firefox += 1;
    else if (dataforbrowser[i].browser == "Safari") Safari += 1;
    else if (dataforbrowser[i].browser == "Chrome") Chrome += 1;
    else if (dataforbrowser[i].browser == "Edge") Edge += 1;
    else if (dataforbrowser[i].browser == "Opera") Opera += 1;
    else if (dataforbrowser[i].browser == "Handheld Browser") Handheld += 1;

  }

  return [IE, Firefox, Safari, Chrome, Edge, Opera, Handheld];
}

function platformCount(dataforplatform) {

  let Windows = 0,
    Mac = 0,
    Linux = 0,
    Android = 0,
    Mobile = 0,
    iPhone = 0;

  for (let i in dataforplatform) {
    if (dataforplatform[i].platform == "Windows") Windows += 1;
    else if (dataforplatform[i].platform == "Mac") Mac += 1;
    else if (dataforplatform[i].platform == "Linux") Linux += 1;
    else if (dataforplatform[i].platform == "Android") Android += 1;
    else if (dataforplatform[i].platform == "Mobile") Mobile += 1;
    else if (dataforplatform[i].platform == "iPhone") iPhone += 1;
  }

  return [Windows, Mac, Linux, Android, Mobile, iPhone];
}

function viewCount(dataforviews) {

  let January = 0,
    February = 0,
    March = 0,
    April = 0,
    May = 0,
    June = 0,
    July = 0,
    August = 0,
    September = 0,
    October = 0,
    November = 0,
    December = 0;

  for (i in dataforviews) {
    let month = new Date(dataforviews[i].time_visited.split(" ")[0]).getMonth();

    switch (month) {
      case 1:
        January += 1;
        break;
      case 2:
        February += 1;
        break;
      case 3:
        March += 1;
        break;
      case 4:
        April += 1;
        break;
      case 5:
        May += 1;
        break;
      case 6:
        June += 1;
        break;
      case 7:
        July += 1;
        break;
      case 8:
        August += 1;
        break;
      case 9:
        September += 1;
        break;
      case 10:
        October += 1;
        break;
      case 11:
        November += 1;
        break;
      case 12:
        December += 1;
        break;
    }
  }

  return [January, February, March, April, May, June, July, August, September, October, November, December];

}

let requestLink = "http://localhost:8000/graphData.php?url_id=" + urlId;
$(document).ready(function () {

  $.ajax({
    url: requestLink,
    dataType: "json",
    type: "GET",
    success: function (data) {

      let dataforbrowser = {
        labels: ["Internet Explorer", "Firefox", "Safari", "Chrome", "Edge", "Opera", "Handheld Browser"],
        datasets: [{
          label: "Browser",
          data: browserCount(data),
          backgroundColor: [
            "#c300ff",
            "#A9A9A9",
            "#DC143C",
            "#F4A460",
            "#2E8B57",
            "#fbff00",
            "#007bff"
          ],
          borderColor: [
            "#77029c",
            "#989898",
            "#CB252B",
            "#E39371",
            "#1D7A46",
            "#d4d64b",
            "#0c4c91",
          ],
          borderWidth: [1, 1, 1, 1, 1, 1, 1]
        }]

      };
      let options1 = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Browser Usage",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };

      let ctx = $("#myChart");
      var chart1 = new Chart(ctx, {
        type: "pie",
        data: dataforbrowser,
        options: options1
      });
      //Platform
      let dataforplatform = {
        labels: ["Windows", "Mac", "Linux", "Android", "Mobile", "iPhone"],
        datasets: [{
          label: "Platform",
          data: platformCount(data),
          backgroundColor: [
            "#c300ff",
            "#A9A9A9",
            "#DC143C",
            "#F4A460",
            "#2E8B57",
            "#fbff00",
          ],
          borderColor: [
            "#77029c",
            "#989898",
            "#CB252B",
            "#E39371",
            "#1D7A46",
            "#d4d64b",
          ],
          borderWidth: [1, 1, 1, 1, 1, 1]
        }]

      };
      let options2 = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Platform",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };

      let ctx1 = $("#platform");
      var chart2 = new Chart(ctx1, {
        type: "pie",
        data: dataforplatform,
        options: options2
      });

      //views
      var dataforviews = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
          label: "View Count",
          data: viewCount(data),
          backgroundColor: "blue",
          borderColor: "lightblue",
          fill: false,
          lineTension: 0,
          pointRadius: 5
        }, ]
      };

      var option3 = {
        title: {
          display: true,
          position: "top",
          text: "Views",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom"
        }
      };

      let ctx2 = $("#views");

      var chart3 = new Chart(ctx2, {
        type: "line",
        data: dataforviews,
        options: option3
      });

    },
    error: function (data) {
      console.log(data);
    }



  });

});