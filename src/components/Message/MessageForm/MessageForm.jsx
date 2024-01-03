import React, { useState, useEffect } from "react";
import MessagesList from "../MessagesList/MessagesList";
import { Open } from "../../../../assets";
import { useFormik } from "formik";
import { initialValues } from "./MessageForm.data";
import { Dashboard } from "../../../api";
import { DraggableMsg } from "../DraggableMsg";
import SortableItem from "../SortableItem/SortableItem";
import { generarId } from "../../../helpers";

const dashboard = new Dashboard();

const MessageForm = () => {
  //api functions
  const { createMessages, getData } = dashboard;

  //useStates
  const [messages, setMessages] = useState([]);

  //useEffects
  useEffect(() => {
    (async () => {
      try {
        const response = await getData();
        if (response.data.messages) {
          setMessages(response.data.messages);
        } else {
          setMessages(formik.values.messages);
        }
      } catch (error) {
        console.error(error);
      }
    })();
  }, []);

  useEffect(() => {
    formik.setFieldValue("messages", messages);
  }, [messages]);

  //formik
  const formik = useFormik({
    initialValues: initialValues(),
    onSubmit: async ({ messages }) => {
      createMessages(messages);
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
          onClick={() => {
            const newMessages = [...messages];
            newMessages.splice(0, 0, {
              id: generarId(),
              text: "Write your new message here",
            });
            setMessages(newMessages);
          }}
        >
          <Open fill={"white"} />
        </button>
      </div>
      <div className="messages">
        <DraggableMsg messages={messages} setMessages={setMessages}>
          {messages.map((message, index) => {
            const { id, text } = message;
            return (
              <SortableItem key={id} id={id}>
                <MessagesList
                  index={index}
                  message={text}
                  messages={messages}
                  setMessages={setMessages}
                />
              </SortableItem>
            );
          })}
        </DraggableMsg>
      </div>
      <form onSubmit={formik.handleSubmit}>
        <input name="messages" type="hidden" value={messages} />
        <input className="form-element__submit" type="submit" value="Update" />
      </form>
    </div>
  );
};

export default MessageForm;
