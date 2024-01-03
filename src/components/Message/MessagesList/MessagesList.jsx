import React, { useState, useEffect } from "react";
import { Close } from "../../../../assets";
import "./MessagesList.scss";

const MessagesList = ({ index, message, messages, setMessages }) => {
  const [value, setValue] = useState(message);

  useEffect(() => {
    const newMessages = [...messages];
    newMessages[index] = { ...newMessages[index], text: value };
    setMessages(newMessages);
  }, [value]);

  //functions
  function deleteMessage(currentIndex) {
    const newMessages = messages.filter(function (_, index) {
      return index !== currentIndex;
    });
    setMessages(newMessages);
  }

  return (
    <div className="messages-list">
      <input
        className="form-element__input"
        type="text"
        value={value}
        onChange={(newValue) => setValue(newValue.target.value)}
      />
      <div className="messages-list__options">
        <button
          className="messages-list__btn messages-list__btn--delete"
          onClick={() => deleteMessage(index)}
        >
          <Close />
        </button>
      </div>
    </div>
  );
};

export default MessagesList;
