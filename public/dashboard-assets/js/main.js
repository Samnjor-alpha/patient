'use strict';
//buttons

let callBtn    =$('#callBtn');
let callBox    =$('#callBox');a
let answerBtn  =$('#answerBtn');
let declineBtn =$('#declineBtn');
let timerlabel= $('#callTimer');
let alertBox= $('#alertBox');
let pc;
let sendTo =callBtn.data('user');
let localStream;

//video elements
const  remoteVideo = document.querySelector("#remoteVideo");
const  localVideo = document.querySelector("#localVideo");

//media info
const mediaConst = {
  video:true,
    audio:true
};
const config ={
    iceServers:[
        {urls:'stun:stun1.l.google.com:19302'},
    ]
}
const options = {
   offerToReceiveVideo:1,
    offerToReceiveAudio:1
}
function getConn(){
    if (!pc){
        pc= new RTCPeerConnection(config);
    }
}
//ask media output
async function getCam() {
    let mediaStream;
    try {
        if (!pc) {
            await getConn();
        }
        mediaStream = await navigator.mediaDevices.getUserMedia(mediaConst);
        localVideo.srcObject = mediaStream;
        localStream = mediaStream;
        localStream.getTracks().forEach(track => pc.addTrack(track, localStream));
    } catch (error) {
        console.log(error)
    }
}
async function createOffer(sendTo){
    await sendIceCandidate(sendTo);
    await pc.createOffer(options);
    await pc.setLocalDescription(pc.localDescription);
    send('client-offer',pc.localDescription,sendTo)
}
async  function createAnswer(sendTo,data){
    if (!pc){
        await getConn();
    }
    if (!localStream){
        await getCam();
    }
    await  sendIceCandidate(sendTo);
    await pc.setRemoteDescription(data);
    await pc.createAnswer();
    await pc.setLocalDescription(pc.localDescription);
    send('client-answer',pc.localDescription,sendTo);
}
function sendIceCandidate(sendTo){
    pc.onicecandidate =e =>{
        if (e.candidate!==null){
            //sendice candidate to tother candidate
            send('client-candidate',e.candidate,sendTo);
        }
    }
    pc.ontrack  = e =>{
        $('#video').removeClass('hidden');
        $('#profile').addClass('hidden');
        remoteVideo.srcObject = e.streams[0];

    }
}
  function hangup(){
    send('client-hangup',null,sendTo);
    pc.close();
    pc= null
  }
$('#hangupBtn').on('click',() =>{
hangup();
location.reload();
    });
callBtn.on('click',() =>{
    getCam();
    send('is-client-ready',null,sendTo);
});
conn.onopen = e=>{
    console.log('connected to websocket');
}



conn.onmessage = async e =>{
    let message= JSON.parse(e.data);
    let by =message.by;
    let data =message.data;
    let type =message.type;
    let profileImage =message.profileImage;
    let username =message.username;
    $('#username').text(username);
    $('#profileImage').attr('src',profileImage);

    switch (type){
        case 'client-candidate':
            if (!pc.localDescription){
                await pc.addIceCandidate(new RTCIceCandidate(data));
            }
            break;
        case 'client-answer':
            if (pc.localDescription){
                await pc.setRemoteDescription(data);
                timerlabel.timer({format:'%m:%s'});
            }
            break;
        case 'is-client-ready':
            if (!pc){
                await getConn();
            }
            if (pc.iceConnectionState ==="connected"){
                send('client-already-oncall',null,by);
            }else{
                displayCall();
                if(window.location.href.indexOf(username)> -1){
                    answerBtn.on('click',()=>{
                        callBox.addClass('hidden');
                        $('.wrapper').removeClass('glass');
                        send('client-is-ready',null,sendTo);
                    });
                }else{
                    answerBtn.on('click',()=>{
                        callBox.addClass('hidden');
                       redirectToCall(username, by)
                    });
                }


                declineBtn.on('click',()=>{
                    send('client-rejected', null , sendTo);
                    location.reload(true);
                });
            }
            break;
        case'client-offer':
             await createAnswer(sendTo, data);
            timerlabel.timer({format:'%m:%s'});
            break;
        case 'client-is-ready':
             await createOffer(sendTo);
            break;
        case 'client-already-oncall':
            displayAlert(username,profileImage,'is on another call');
            setTimeout('window.location.reload()',2000);
            break;
        case 'client-rejected':
            displayAlert(username,profileImage,'user is busy');
            break;
        case 'client-hangup':
        displayAlert(username,profileImage,'Disconnected the call');
            setTimeout('window.location.reload()',2000);
            break;

    }
}
function send(type,data, sendTo){
    conn.send(JSON.stringify({
        sendTo:sendTo,
        type:type,
        data:data

    }));

}
send('is-client-is-ready',null,sendTo);
function displayCall() {
callBox.removeClass('hidden');
    $('.wrapper').addClass('glass');
}
function displayAlert(username,profileImage,message){
    alertBox.find('#alertName').text(username);
    alertBox.find('#alertImage').attr('src',profileImage);
    alertBox.find('#alertMessage').text(message);
    alertBox.removeClass('hidden');
    $('.wrapper').addClass('glass');
    $('#video').addClass('hidden');
    $('#profile').removeClass('hidden');
}
function  redirectToCall(username,sendTo) {
    if (window.location.href.indexOf(username) === -1) {
        sessionStorage.setItem('redirect', true);
        sessionStorage.setItem('sendTo',sendTo);
        window.location.href='/chat/'+username;

    }
}
if (sessionStorage.getItem('redirect')){
    sendTo=sessionStorage.getItem('sendTo');
    let waitForWs = setInterval(() =>{
        if(conn.readyState === 1){
            send('client-is-ready',null,sendTo);
            clearInterval(waitForWs);
        }
    },500);
    sessionStorage.removeItem('redirect');
    sessionStorage.removeItem('sendTo');

}