const call_bridge_api = function (api, post_body, pass_id, pass_secret, onSuccess, onFailure) {
    let now = Math.floor(Date.now() / 1000);
    axios.post('../bridge' + api, post_body, {
        'X-BRIDGE-PASS-TOKEN': md5(pass_id + ':' + pass_secret + '@' + now),
        'X-BRIDGE-PASS-ID': pass_id,
        'X-BRIDGE-PASS-TIME': now,
    }).then(resp => {
        onSuccess(resp);
    }).catch(error => {
        onFailure(error);
    });
}