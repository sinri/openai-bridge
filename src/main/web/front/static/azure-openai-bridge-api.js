const call_bridge_api_for_azure_openai = function (api, post_body, pass_id, pass_secret, onSuccess, onFailure) {
    let now = Math.floor(Date.now() / 1000);
    axios({
        method: 'POST',
        headers: {
            'X-BRIDGE-PASS-TOKEN': md5(pass_id + ':' + pass_secret + '@' + now),
            'X-BRIDGE-PASS-ID': pass_id,
            'X-BRIDGE-PASS-TIME': now,
        },
        data: post_body,
        url: '../bridge' + api,
    })
        .then(resp => {
            onSuccess(resp);
        })
        .catch(error => {
            onFailure(error);
        });
}