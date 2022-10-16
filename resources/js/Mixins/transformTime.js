import moment from 'moment';

export default function (start) {
let date = moment(start);
    return date.format('YYYY-MM-DD HH:mm:ss');
}