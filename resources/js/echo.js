import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
console.log(chatId);

// window.Echo.private(`xabar.${chatId}`)
window.Echo.channel(`xabar.${chatId}`)
    .listen('MessageEvent', (e) => {
        console.log(e);
        const messageList = document.getElementById('messageList');
        const newMessage = document.createElement('li');
        newMessage.innerHTML = `<span class="text-danger">${e.sender.name}</span>: ${e.text}`;
        messageList.prepend(newMessage);
    });






// window.Echo.channel('xabar')
//     .listen('MessageEvent', (e) => {
//         console.log(e);
//         const messageList = document.getElementById('messageList');
        
//         const newMessage = document.createElement('li');
//         const newImage = document.createElement('img');
//         newImage.src = e.message.img;
//         newImage.width = 100;
//         messageList.prepend(newImage);
        
//         newMessage.innerText = e.message.text;  
//         messageList.prepend(newMessage);  

//     });



















// window.Echo.private(`xabar.${userId}`) // `userId` - hozirgi auth foydalanuvchi ID
// .listen('MessageEvent', (e) => {
//     console.log(e);
//     const messageList = document.getElementById('messageList');
    
//     const newMessage = document.createElement('li');
//     newMessage.innerText = `${e.senderId}: ${e.message}`;
//     messageList.prepend(newMessage);
// });
