export function HtoUpperCaseFirstLetter(letter) {

    return letter.toLowerCase().replace(/\b[a-z]/g, function (letter) {
        return letter.toUpperCase();
    })
}
export function HconvertTo12hoursFormat(hours) {
    let AmOrPm = hours >= 12 ? ' pm' : ' am';
    if(hours == 24) AmOrPm = ' am';
    hours = (hours % 12) || 12;
    const finalTime = hours + AmOrPm;
    return finalTime;
}

export function HstringToObjectConverter(obj,stringObj) {
    obj = JSON.parse(stringObj);
    return obj;
}
