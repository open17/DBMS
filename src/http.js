import axios from 'axios';

const http = axios.create({
  baseURL: 'http://localhost:3000/backend/', // 设置基本URL
  timeout: 5000 // 设置请求超时时间
});

// 可以在此处设置请求拦截器、响应拦截器等，根据需要进行定制

export default http;