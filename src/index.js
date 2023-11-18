import React from "react";
import ReactDOM from "react-dom";
import App from "./App.jsx";
import "./scss/index.scss";

const root = document.getElementById("dcnicclicktochat-update-me");
ReactDOM.createRoot(root).render(<App />);
root.removeAttribute("id");
