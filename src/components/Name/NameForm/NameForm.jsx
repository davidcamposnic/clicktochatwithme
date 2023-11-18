import React, { useState, useEffect } from "react";
import "./NameForm.scss";
import { useFormik } from "formik";
import { initialValues, validationSchema } from "./NameForm.data";
import { Dashboard } from "../../../api";

const dashboardCollection = new Dashboard();

const NameForm = () => {
  const { createName, getName } = dashboardCollection;

  const [name, setName] = useState("");
  const [results, setResults] = useState({});

  useEffect(() => {
    (async () => {
      try {
        const response = await getName();
        setName(response.data.name);
      } catch (error) {
        console.error(error);
      }
    })();
  }, []);

  const formik = useFormik({
    initialValues: initialValues(),
    validationSchema: validationSchema(),
    validateOnChange: true,
    onSubmit: async ({ name }) => {
      await createName(name);
      setName(name);
    },
  });

  return (
    <div className="name-form">
      <div className="name-form__wrapper">
        <h2>Describe your assistant</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet nemo
          fuga labore.
        </p>
        <form className="name-form__container" onSubmit={formik.handleSubmit}>
          <div className="form-element__group elements-group elements-group__image">
            <div className="form-element__image">
              <input type="hidden" />
              <img src="" alt="" />
            </div>
            <div className="elements-group__label-input">
              <label className="form-element__label" htmlFor="name">
                Name
              </label>
              <input
                className="form-element__input"
                type="text"
                name="name"
                id="name"
                placeholder="Describe the name of your virtual assitant"
                onChange={formik.handleChange}
                error={formik.errors.name}
              />
            </div>
          </div>
          <p className="">
            Your assistant name is: <span>{name}</span>
          </p>
          <input
            className="form-element__submit"
            type="submit"
            value="Update"
          />
        </form>
      </div>
    </div>
  );
};

export default NameForm;
