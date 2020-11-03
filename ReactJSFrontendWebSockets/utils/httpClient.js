import axios from "axios";

const CancelToken = axios.CancelToken;
const source = CancelToken.source();

axios.defaults.xsrfHeaderName = "X-CSRFToken";
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    'Accept': 'application/json'
}
axios.defaults.xsrfCookieName = 'XSRF-TOKEN';
axios.defaults.trailingSlash = false;

export default axios.create({
    baseURL: "/api",
    responseType: "json",
    cancelToken: source.token
});
