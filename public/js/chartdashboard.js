
async function makeChart(ctx, type, title, datacharts, datachartName, label) {
  window.addEventListener('beforeprint', () => {
    ctx.resize(600, 600);
  });
  window.addEventListener('afterprint', () => {
    ctx.resize();
  });
  let data = {
    labels: [],
    datasets: [],
    tension: 0.1
  }
  let options = {
    responsive: true,
    maintainAspectRatio: false,
    resizeDelay: 800,
    title: {
      display: true,
      text: title
    },
    legend: {
      display: true
    },
    sscale: {
      yAxes: [
        {
          ticks: {
            bbeginAtZero: false
          }
        }
      ]
    },
    elements: {
      point: {
        backgroundColor: "#ffffff"
      }
    }
  }
  
  let typeSpecial = ["line", "bubble", "polarArea"]
  if (!typeSpecial.includes(type)) {
    let obj = {
        label: label,
        backgroundColor: random_rgba(),
        fill: true,
        data: [...datacharts],
        borderColor: random_rgba(),
        borderWidth: 2
      }
    
    data.labels = [...datachartName]
    data.datasets.push(obj)
  } else {
    /*
    for (let name of datachartName) {
      data.labels.push(name)
    }
    */
    data.labels = [...datachartName]
    data.datasets[0] = {
      label: label,
      backgroundColor: random_rgba(),
      fill: true,
      data: [...datacharts],
      borderColor: random_rgba(),
      borderWidth: 2
    }
  }
  /*
  if (label !== null && typeof label === "object") {
    label.forEach(function(name){
     data.datasets[0].label.push(name)
    })
  } else {
    options.title.text = title
    datachartName.forEach(function(_){
      data.labels.push(_)
    })
    datachart.forEach(function(_){
      data.datasets[0].data.push(_)
    })
    */
    /*
    datachart.forEach(function(_){
      data.datasets.push({
        label: label,
        backgroundColor: random_rgba(),
        fill: true,
        data: _,
        borderColor: "#d1dbdd",
        borderWidth: 2
      })
    })
    */
    return new Chart(ctx, {
        type: type,
        data: data,
        options: options
      })
}



function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}