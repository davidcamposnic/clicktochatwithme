import React, { useState, useEffect } from "react";
import MessagesList from "../MessagesList/MessagesList";
import { Close, Open } from "../../../../assets";
import { useFormik } from "formik";
import { initialValues, validationSchema } from "./MessageForm.data";

const MessageForm = () => {
  const [messages, setMessages] = useState([]);

  useEffect(() => {
    setMessages([
      "Here we are going to check all our messages",
      "My second message here",
    ]);
  }, []);

  // const formik = useFormik({
  //   onSubmit: (e) => {
  //     e.preventDefault();
  //   },
  // });

  const formik = useFormik({
    initialValues: initialValues(),
    onSubmit: ({ messages }) => {
      console.log(messages);
    },
  });

  return (
    <div className="card">
      <div className="flex justify-between items-center">
        <div>
          <h2>Messages list</h2>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Expedita
            voluptate maiores aperiam dolores aspernatur?
          </p>
        </div>
        <button
          className="btn btn--icon"
          onClick={() => setMessages([...messages, "Write your new message"])}
        >
          <Open fill={"white"} />
        </button>
      </div>
      {messages.map((message, index) => (
        <MessagesList key={index} message={message} />
      ))}
      <form className="" onSubmit={formik.handleSubmit}>
        <input name="messages" type="hidden" value={messages} />
        <input className="form-element__submit" type="submit" value="Update" />
      </form>
    </div>
  );
};

export default MessageForm;
