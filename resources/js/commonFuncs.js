import {usePage} from '@inertiajs/inertia-vue3';
import {settingsAwesomeFontLabels} from '@/app.settings'
import moment from 'moment-timezone'


export function formatValue(value, rateDecimalNumbers) {
    if (isEmpty( value ) ) return ''
    if ( typeof value === 'string' ) {
        value = parseFloat(value)
    }
    return value.toFixed(rateDecimalNumbers)
}

export function dateIntoDbFormat(d) {
    if (isEmpty(d))  {
        d = new Date()
    }
    let ret = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    return ret;
}

export function showFlashMessage() {
    let icon = 'success'

    let flash_message = usePage().props.value.jetstream.flash

    let flash_type = usePage().props.value.flash_type.message

    if ( !isEmpty(flash_message)  ) {
        if (flash_type == 'warning') {
            icon = 'warning'
        }

        if (flash_type == 'error') {
            icon = 'error'
        }
        Toast.fire({
            icon: icon,
            title: flash_message
        })
    }
}

export function moneyFormat(price) {
    if (typeof price === 'undefined' || typeof price === 'object') {
        price = 0
    }
    if (typeof price === 'string') {
        price = parseFloat(price)
    }
    return '$' + price.toFixed(2)
}

export function momentDatetime(datetime, datetimeFormat, defaultVal) {
    if (typeof datetime === 'undefined' || datetime === null) {
        if (typeof defaultVal !== 'undefined' && defaultVal !== null) {
            return defaultVal
        }
        return ''
    }
    if (typeof datetime === 'object') {
        return moment(datetime).format(datetimeFormat)
    }
    if (typeof datetime === 'string') {
        if (datetimeFormat === '') return ''
        let dt = moment(String(datetime))
        return dt.format(datetimeFormat)
    } // if (typeof datetime === "string") {
    return ''
} // momentDatetime(datetime, datetimeFormat, defaultVal) {

export function getDictionaryLabel(value, selectionsList, defaultValue) {
    if (typeof defaultValue === 'undefined') defaultValue = ''
    if (typeof selectionsList === 'undefined') return defaultValue
    var ret = defaultValue
    selectionsList.map((nextSelection/* , index */) => {
        if (nextSelection.code === value) {
            ret = nextSelection.label
        }
    })
    return ret
} // getDictionaryLabel( value, selectionsList, defaultValue ) {

export function upperCase(string) {
    if (typeof string !== 'string') return ''
    return string.toUpperCase()
}

export function lowerase(string) {
    if (typeof string !== 'string') return ''
    return string.toLowerCase(0)
}

export function concatStr(str, maxStrLengthInListing) {
    if (typeof str === 'undefined') str = ''
    if (str.length > maxStrLengthInListing) {
        return str.slice(0, maxStrLengthInListing) + '...'
    }
    return str
}

export function capitalize(string) {
    if (typeof string !== 'string') return ''
    return string.charAt(0).toUpperCase() + string.slice(1)
}

export function clearErrorMessage(s) {
    if (typeof s === 'undefined') return ''
    return capitalize(s.replace(/_/g, ' '))
}

export function timeInAgoFormat(value) {
    if (value === null || typeof value === 'undefined') return
    return capitalize(moment(value).fromNow())
}

export function pluralize3(items_length, no_items_text, single_item_text, multi_items_text) {
    if (typeof items_length !== 'number') return no_items_text
    if (items_length === 0) return no_items_text
    if (items_length === 1) return single_item_text
    if (items_length > 1) return multi_items_text
}

export function pluralize(itemsLength, singleLabel, pluralLabel) {
    return itemsLength > 1 ? pluralLabel : singleLabel
}

export function clearTags(str) {
    if (typeof str !== 'string') return ''
    return str.replace(/<\/?[^>]+(>|$)/g, '')
}

export function getHeaderIcon(icon) {
    let retIcon = ''
    settingsAwesomeFontLabels.map((nextSettingsAwesomeFontLabel) => {
        if (nextSettingsAwesomeFontLabel.code === icon) {
            retIcon = nextSettingsAwesomeFontLabel.font
            return retIcon
        }
    })
    return retIcon
}

export function isEmpty(value) {
    if (typeof value === 'object') {
        if (value === null) return true
        if (value.length === 0) return true
    }
    if (value === undefined) return true
    if (value === null) return true
    if (value === '') return true
}

export function getSplitted(str, splitter, index) {
    if (typeof str === 'undefined') return ''
    var valuesArray = str.split(splitter)
    if (typeof valuesArray[index] !== 'undefined') {
        return valuesArray[index]
    }
    return ''
}

