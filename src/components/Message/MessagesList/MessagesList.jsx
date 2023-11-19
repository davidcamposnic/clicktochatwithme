import React, { useState, useEffect } from "react";
import "./MessagesList.scss";

const MessagesList = ({ message }) => {
  const [value, setValue] = useState("");

  useEffect(() => {
    setValue(message);
  }, []);
  return (
    <div className="messages-list">
      <input
        type="text"
        value={message}
        onChange={(newValue) => setMessage(newValue.value)}
      />
      <div className="messages-list__options">
        <button className="messages-list__edit"></button>
        <button className="messages-list__delete"></button>
      </div>
    </div>
  );
};

export default MessagesList;
