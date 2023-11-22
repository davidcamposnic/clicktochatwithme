import React, { useState, useEffect } from "react";
import { Close } from "../../../../assets";
import "./MessagesList.scss";
import { MediaUpload } from "@wordpress/block-editor";
import { MediaUploadCheck } from "../../Shared";

const MessagesList = ({ index, message, messages, setMessages }) => {
  const [value, setValue] = useState(message);

  useEffect(() => {
    const newMessages = [...messages];
    newMessages.splice(index, 1, value);
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
      <MediaUploadCheck>
        {/* <MediaUpload
          onSelect={(e) => console.log(e)}
          multiple={true}
          value={""}
          addToGallery={true}
          gallery={true}
          render={({ open }) => {
            return (
              <>
                <div className="elemberg-control-gallery-content">
                  <button
                    className="elemberg-control-gallery-content__add-image"
                    onClick={open}
                    label="Add Image"
                  />
                </div>
              </>
            );
          }}
        /> */}
      </MediaUploadCheck>
      <input
        className="form-element__input"
        type="text"
        value={message}
        onChange={(newValue) => {
          setValue(newValue.target.value);
        }}
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
