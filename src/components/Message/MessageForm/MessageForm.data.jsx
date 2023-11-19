import * as Yup from "yup";

export function initialValues() {
  return {
    messages: [
      "Here we are going to check all our messages",
      "My second message here",
    ],
  };
}

export function validationSchema() {
  return Yup.object({
    messages: Yup.string().required(true),
  });
}
