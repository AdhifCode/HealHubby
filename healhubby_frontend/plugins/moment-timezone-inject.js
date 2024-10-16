const moment = require('moment-timezone')
export default ({ app }, inject) => {
  inject('moment_timezone', moment)
}
