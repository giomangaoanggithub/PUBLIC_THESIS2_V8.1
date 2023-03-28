// page_teacher.php
$("#grades_reset_btn").click(function () {
  student_grades_reset_btn();
});

$("#account_settings").click(function () {
  window.location.href = "page_account_settings.php";
});

$("#create-questions").click(function () {
  window.location.href = "page_teacher_question.php";
});

$("#classroom-students").click(function () {
  window.location.href = "page_teacher_view_students.php";
});

$("#create-room-btn").click(function () {
  $.post(
    "zerver_page_create_change_room_param.php",
    {
      outcome: 0,
    },
    function () {
      window.location.href = "page_create_change_room.php";
    }
  );
});

$("#change-room-btn").click(function () {
  $.get("zerver_page_teacher_no_pick.php", function (data) {
    // alert(data);
    $.post(
      "zerver_page_create_change_room_param.php",
      {
        outcome: 1,
      },
      function () {
        window.location.href = "page_create_change_room.php";
      }
    );
  });
});

$("#logout-btn").click(function () {
  window.location.href = "index.php";
});

$("#simulate").click(function () {
  sim_q = `This is a simulated question.`;
  arr_inputs = [
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed is the amount of space an object covers in a given amount of time, whereas velocity is simply speed plus direction, also referred to as a vector. The difference between distance and displacement is that while both measure how much ground an object has covered, displacement demonstrates how far an object has moved from its original location.`,
    `Speed is the distance an object travels in a unit of time, whereas velocity is speed plus direction, often known as a vector. Although distance and displacement are comparable, they differ primarily in that distance indicates how much ground an object has covered and displacement indicates how far an object has moved from its original location.`,
    `While velocity is essentially speed with the addition of direction or known as a vector, speed refers to an object's journey distance over time. While distance and displacement are comparable concepts, they vary fundamentally in that the former measures how much territory an item has covered while the latter demonstrates how far an object has moved from its original location.`,
    `Speed is the distance traveled by an object over time, whereas velocity is speed with the addition of direction, sometimes known as a vector. Distance and displacement are comparable, but the main distinction is that distance informs how much ground an item has covered, whereas displacement shows how far out of position an object is.`,
    `Speed is the distance an item travels over time, whereas velocity is speed plus direction, often known as a vector. Both distance and displacement are comparable, but the main distinction is that distance indicates how much ground an object has covered, whereas displacement indicates how far out of place an object is.`,
    `Speed is the distance traveled by an object over time, whereas velocity is speed plus direction, also known as a vector. Distance and displacement are similar, but the main difference is that distance indicates how much ground an object has covered, whereas displacement indicates how far out `,
    `Speed refers to how far an object travels in a given time, while velocity describes the speed and direction of an object. The two measures of distance and displacement are similar, but the key difference is that distance shows how much ground an object has covered, while displacement shows how far away an object is from its original location.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance an object has traveled and the displacement it has caused are both similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. Compared to distance, displacement provides a more accurate depiction of an object's position. The difference is that distance measures how far an object has traveled, while displacement measures how far an object is from its normal position.`,
    `Speed indicates how far an object travels over a period of time, while velocity measures how quickly an object moves with respect to a specific direction or axis. The two measures can be compared by noting the difference between the object's distance traveled and its displacement.`,
    `Speed refers to the distance an object travels over time, while velocity is a measure of speed with an inclusion of direction or known as a vector. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. Regarding the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed refers to how far an object travels in a short period of time, while velocity is how fast an object is moving in a particular direction. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance and displacement measurements are both similar, but the core difference is that distance measures how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed and Distance are scalar quantity in other words it only considers the magnitude, while Velocity and Displacement is a vector quantity which not only considers the magnitude, but also the direction of the object.`,
    `Speed talks about how fast and velocity also fast but with a sense of route. Distance and Displacement may look the same if we only calculate one line, but with more multiple lines we can easily differ displacement from distance.`,
    `If the object heads only from point A to point B without any form of direction then it is scalar value, but if the object has some direction, then it is considered a vector value.`,
    `Speed is the amount of space an object covers in a given amount of time, whereas velocity is simply speed plus direction, also referred to as a vector. The difference between distance and displacement is that while both measure how much ground an object has covered, displacement demonstrates how far an object has moved from its original location.`,
    `Speed is the distance an object travels in a unit of time, whereas velocity is speed plus direction, often known as a vector. Although distance and displacement are comparable, they differ primarily in that distance indicates how much ground an object has covered and displacement indicates how far an object has moved from its original location.`,
    `While velocity is essentially speed with the addition of direction or known as a vector, speed refers to an object's journey distance over time. While distance and displacement are comparable concepts, they vary fundamentally in that the former measures how much territory an item has covered while the latter demonstrates how far an object has moved from its original location.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. Regarding the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed refers to how far an object travels in a short period of time, while velocity is how fast an object is moving in a particular direction. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.`,
    `Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance and displacement measurements are both similar, but the core difference is that distance measures how much ground an object has covered, while displacement shows how far out of place an object is.`,
    `Speed and Distance are scalar quantity in other words it only considers the magnitude, while Velocity and Displacement is a vector quantity which not only considers the magnitude, but also the direction of the object.`,
    `Speed refers to an object travel distance over period, while velocity is fundamentally speed with an addition of course or known as a heading. As for the distance and dislocation, both are related, but the center difference is that the distance discerns how much ground an object has closed, while displacement shows by virtue of what unusual of place an object is.`,
    `Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are identical, but the center distinctness is that the distance speaks by means of what much ground an object has hidden, while dislocation shows in what way or manner unusual of place an object is.`,
    `Speed refers to an object travel distance over opportunity, while speed is fundamentally speed accompanying an addition of course or popular as a heading. Concerning the distance and dislocation, two together are analogous, but the center dissimilarity is that the distance speaks by what method much ground an object has marked, while dislocation shows by virtue of what unusual of place an object is.`,
    `Speed refers to an object travel distance over period, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are related, but the center dissimilarity is that the distance understands in what way or manner much ground an object has hidden, while dislocation shows by what method unusual of place an object is.`,
    `Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of management or popular as a heading. Concerning the distance and dislocation, two together are identical, but the gist dissimilarity is that the distance reports by means of what much ground an object has dotted, while dislocation shows in what way or manner unusual of place an object is.`,
    `Speed alludes to an question travel remove over time, whereas speed is essentially speed with an consideration of heading or known as a vector. As for the remove and uprooting, both are comparable, but the center distinction is that the separate tells how much ground an question has secured, whereas uprooting appears how distant out of put an protest is.`,
    `Speed and Remove are scalar amount in other words it as it were considers the greatness, whereas Speed and Uprooting may be a vector amount which not as it were considers the greatness, but moreover the course of the question.`,
    `Speed and Distance are scalar amount in different phrases it handiest considers the magnitude, even as Velocity and Displacement is a vector amount which now no longer handiest considers the magnitude, however additionally the course of the object.`,
    `Speed and Distance are scalar amount in different words it solely considers the magnitude, whereas rate and Displacement could be a vector quantity that not only considers the magnitude, however conjointly the direction of the object.`,
    `Speed and distance are scalar quantities, in other words, they only consider size, while speed and displacement are vector quantities, which consider not only size but also direction of the object.`,
    `Speed refers to an object travel distance over period, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are related, but the center dissimilarity is that the distance understands in what way or manner much ground an object has hidden, while dislocation shows by what method unusual of place an object is.`,
    `Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of management or popular as a heading. Concerning the distance and dislocation, two together are identical, but the gist dissimilarity is that the distance reports by means of what much ground an object has dotted, while dislocation shows in what way or manner unusual of place an object is.`,
    `Speed alludes to an question travel remove over time, whereas speed is essentially speed with an consideration of heading or known as a vector. As for the remove and uprooting, both are comparable, but the center distinction is that the separate tells how much ground an question has secured, whereas uprooting appears how distant out of put an protest is.`,
    `Speed and Remove are scalar amount in other words it as it were considers the greatness, whereas Speed and Uprooting may be a vector amount which not as it were considers the greatness, but moreover the course of the question.`,
    `The ancient Greeks called cake πλακοῦς (plakous), which was derived from the word for "flat", πλακόεις (plakoeis). It was baked using flour mixed with eggs, milk, nuts, and honey. They also had a cake called "satura", which was a flat heavy cake. During the Roman period, the name for cake became "placenta" which was derived from the Greek term. A placenta was baked on a pastry base or inside a pastry case.`,
    `God of War Collection was first released in North America on November 17, 2009, for the PlayStation 3—the franchise's first appearance on the platform. It is a remastered port of the original God of War and God of War II.[21] The games were ported by Bluepoint Games and feature high-definition 1080p anti-aliased graphics at 60 frames per second and trophies.[22] Sanzaru Games later ported the collection to the PlayStation.`,
    `American teenager Peter Parker, a poor sickly orphan, is bitten by a radioactive spider. As a result of the bite, he gains superhuman strength, speed, and agility, along with the ability to cling to walls, turning him into Spider-Man. Parker also acquired a precognitive “spidey-sense” that alerted him to approaching dangers.`,
    `When The Flash reaches his destination, he can activate the skill again to return to where he started, dealing magic damage. Enemies damaged by the initial dash are dealt an additional magic damage. Shortly after settling back in Titans Tower, Bart reveals to Conner that during his brief stay in the future, he went through a number of records and schematics concerning technology from the era.`,
    `Our paid workshops and trainings will help you and your team level-up your remote skills. Whether you want to perfect your own game, be a better remote colleague, or lead a remote team, our professional workshops will give you all the best practices to rock the remote world. If you've got to choose between super maggots, gold balls, and explosive farts, it stands to reason that explosive farts is by far the crappiest.`,
    `Aside from the obvious bonus of being able to talk with your loved ones that have since passed on, speaking with the dead would also be majorly helpful in solving the unsolvable crimes. Can't figure out who killed the victim? Easy: Ask the victim, case closed. Proving that in a court of law is another thing entirely, but having a prosecuting attourney with the power of persuasion would probably help.`,
    `A dissertation tesis doctoral, with an average of 250 pages, is the main requisite along with typically one previously published journal article. Once candidates have published their written dissertations, they will be evaluated by two external academics evaluadores externos and subsequently it is usually exhibited publicly for fifteen natural days.`,
    `In Portugal and Brazil, a dissertation is required for completion of a master's degree. The defense is done in a public presentation in which teachers, students, and the general public can participate. For the PhD, a thesis tese is presented for defense in a public exam. The exam typically extends over 3 hours.`,
    `Additionally, he notes, many people who believe they suffer from excessive gas production actually just have trouble with the flow of that gas through their intestines, perhaps due to constipation. Or they might make the same amount of gas but emit it more frequently, in smaller doses. In either case, Kashyap says, by changing your diet, you're not solving the problem and may in fact be harming yourself.`,
    `Glory to God in the highest And on earth, peace to people of good will We praise You We bless You We adore You We glorify You We give You thanks for Your great glory Lord God, heavenly king O God, almighty Father Lord Jesus Christ Only begotten Son Lord God, Lamb of God Son of the Father You take away the sins of the world Have mercy on us You take away the sins of the world Receive our prayer You are seated at the right hand of the Father Have mercy on us For You alone are the Holy One You alone are the Lord You alone are the Most High, Jesus Christ With the Holy Spirit In the glory of God, the Father Amen`,
    `Failing in life helps to build resilience. The more we fail, the more resilient we become. In order to achieve great success, we must know resilience. Because, if we think that we're going to succeed on the first try, or even the first few tries, then we're sure to set ourselves up for a far more painful failure.`,
  ];
  happen = "";
  $.post(
    "zerver_page_teacher_simulate.php",
    { question: sim_q, step: "0" },
    function () {
      for (x = 0; x < arr_inputs.length; x++) {
        $.post(
          "zerver_page_teacher_simulate.php",
          { answers: arr_inputs[x], step: "1" },
          function (data) {
            happen = data;
          }
        );
      }
      page_start();
    }
  );
});

enable_mouseover = 0;
sentence_focuser = "";

function highlight_sentences(input1, input2) {
  if (
    enable_mouseover == 0 &&
    document.getElementsByClassName(input2)[input1].style.backgroundColor !=
      "rgb(255, 255, 0)"
  ) {
    document.getElementsByClassName(input2)[input1].style.backgroundColor =
      "#f0f095";
  } else if (enable_mouseover == 1) {
    document.getElementsByClassName(sentence_focuser)[
      input1
    ].style.backgroundColor = "#FFFF00";
  } else if (
    document.getElementsByClassName(input2)[input1].style.backgroundColor ==
    "rgb(255, 255, 0)"
  ) {
    document.getElementsByClassName(input2)[input1].style.backgroundColor =
      "#bfb184";
  }
}

function unhighlight_sentences(input1, input2) {
  // alert(document.getElementsByClassName(input2)[input1].style.backgroundColor);
  if (
    enable_mouseover == 0 &&
    document.getElementsByClassName(input2)[input1].style.backgroundColor !=
      "rgb(191, 177, 132)" &&
    document.getElementsByClassName(input2)[input1].style.backgroundColor !=
      "rgb(255, 255, 0)"
  ) {
    document.getElementsByClassName(input2)[input1].style.backgroundColor =
      "transparent";
  } else if (
    enable_mouseover == 0 &&
    document.getElementsByClassName(input2)[input1].style.backgroundColor ==
      "rgb(191, 177, 132)"
  ) {
    document.getElementsByClassName(input2)[input1].style.backgroundColor =
      "#FFFF00";
  }
}

function enable_highlight(input1, input2) {
  if (
    document.getElementsByClassName(input2)[input1].style.backgroundColor ==
      "rgb(191, 177, 132)" &&
    enable_mouseover == 0
  ) {
    document.getElementsByClassName(input2)[input1].style.backgroundColor =
      "transparent";
    enable_mouseover = 0;
    return;
  }
  document.getElementsByClassName(input2)[input1].style.backgroundColor =
    "#FFFF00";
  if (enable_mouseover == 0) {
    enable_mouseover++;
    sentence_focuser = input2;
  } else {
    enable_mouseover--;
  }
}

function undo_all(input1) {
  input1 = input1.replace("undo_id_", "");
  for (
    x = 0;
    x < document.getElementsByClassName("answer_id_" + input1).length;
    x++
  ) {
    document.getElementsByClassName("answer_id_" + input1)[
      x
    ].style.backgroundColor = "transparent";
  }
}

function done_check(input) {
  input = input.replace("done_check_", "");
  arr_context = [];
  arr_type = [];
  hold_arr = [];
  y = 0;
  z = 0;

  for (
    x = 1;
    x < document.getElementsByClassName("answer_id_" + input).length;
    x++
  ) {
    if (
      document.getElementsByClassName("answer_id_" + input)[x - 1].style
        .backgroundColor ==
      document.getElementsByClassName("answer_id_" + input)[x].style
        .backgroundColor
    ) {
      hold_arr[x - 1 - z] = document.getElementsByClassName(
        "answer_id_" + input
      )[x - 1].innerHTML;
    } else {
      hold_arr[x - 1 - z] = document.getElementsByClassName(
        "answer_id_" + input
      )[x - 1].innerHTML;
      arr_context[y] = hold_arr;
      if (
        document.getElementsByClassName("answer_id_" + input)[x - 1].style
          .backgroundColor == "transparent"
      ) {
        arr_type[y] = "[CORRECT]";
      } else {
        arr_type[y] = "[INCORRECT]";
      }
      y++;
      hold_arr = [];
      z = x;
    }
    if (x == document.getElementsByClassName("answer_id_" + input).length - 1) {
      if (
        document.getElementsByClassName("answer_id_" + input)[x - 1].style
          .backgroundColor ==
          document.getElementsByClassName("answer_id_" + input)[x].style
            .backgroundColor &&
        document.getElementsByClassName("answer_id_" + input)[x].style
          .backgroundColor == "transparent"
      ) {
        arr_type[y] = "[CORRECT]";
        hold_arr[x - 1 - z] = document.getElementsByClassName(
          "answer_id_" + input
        )[x - 1].innerHTML;
        hold_arr[x - z] = document.getElementsByClassName("answer_id_" + input)[
          x
        ].innerHTML;
        arr_context[y] = hold_arr;
      } else if (
        document.getElementsByClassName("answer_id_" + input)[x - 1].style
          .backgroundColor ==
          document.getElementsByClassName("answer_id_" + input)[x].style
            .backgroundColor &&
        document.getElementsByClassName("answer_id_" + input)[x].style
          .backgroundColor != "transparent"
      ) {
        arr_type[y] = "[INCORRECT]";
        hold_arr[x - 1 - z] = document.getElementsByClassName(
          "answer_id_" + input
        )[x - 1].innerHTML;
        hold_arr[x - z] = document.getElementsByClassName("answer_id_" + input)[
          x
        ].innerHTML;
        arr_context[y] = hold_arr;
      } else {
        if (
          document.getElementsByClassName("answer_id_" + input)[x].style
            .backgroundColor == "transparent"
        ) {
          arr_type[y] = "[CORRECT]";
          hold_arr[x - z] = document.getElementsByClassName(
            "answer_id_" + input
          )[x].innerHTML;
          arr_context[y] = hold_arr;
        } else {
          arr_type[y] = "[INCORRECT]";
          hold_arr[x - z] = document.getElementsByClassName(
            "answer_id_" + input
          )[x].innerHTML;
          arr_context[y] = hold_arr;
        }
      }
    }
  }

  output = "";
  cor_score = 0;
  inc_score = 0;

  for (x = 0; x < arr_context.length; x++) {
    output += arr_context[x] + " -|- " + arr_type[x] + "\n";
    if (arr_type[x] == "[CORRECT]") {
      cor_score += arr_context[x].length;
    } else if (arr_type[x] == "[INCORRECT]") {
      inc_score += arr_context[x].length;
    }
  }

  // alert(output);

  final_score = (cor_score / (cor_score + inc_score)).toFixed(4) * 100;
  // alert(final_score);
  //HIGHLIGHT FEATURE DONE

  $.post(
    "zerver_page_teacher_fetch_question_id.php",
    { ans_id: input },
    function (data) {
      data = JSON.parse(data);
      // alert(data[0]["question_id"]);
      hold_q_id = data[0]["question_id"];
      $.post(
        "zerver_page_teacher_fetch_curr_param.php",
        { q_id: data[0]["question_id"] },
        function (data) {
          data = JSON.parse(data);
          // alert(data[0]["checking_param"]);
          // alert(data[0]["checking_param"].indexOf("<!@#CORRECT$%^>"));
          inc_param_arr = "";
          cor_param_arr = "";
          for (
            x = 4;
            x < data[0]["checking_param"].indexOf("<!@#CORRECT$%^>");
            x++
          ) {
            inc_param_arr += data[0]["checking_param"][x];
          }
          for (
            x = data[0]["checking_param"].indexOf("<!@#CORRECT$%^>") + 19;
            x < data[0]["checking_param"].length;
            x++
          ) {
            cor_param_arr += data[0]["checking_param"][x];
          }
          inc_param_arr = inc_param_arr.split("<&^>");
          cor_param_arr = cor_param_arr.split("<&*>");
          if (cor_param_arr.length > 4) {
            // alert(cor_param_arr.length);
          }
          for (x = 0; x < arr_context.length; x++) {
            hold_arr = "";
            for (y = 0; y < arr_context[x].length; y++) {
              hold_arr += arr_context[x][y] + ` `;
            }
            arr_context[x] = hold_arr;
            if (arr_type[x] == "[CORRECT]") {
              cor_param_arr.push(arr_context[x]);
            } else {
              inc_param_arr.push(arr_context[x]);
            }
          }

          prep_param = "";

          for (x = 0; x < inc_param_arr.length; x++) {
            if (inc_param_arr[x] != "") {
              prep_param += "<&^>" + inc_param_arr[x];
            }
          }
          prep_param += "<!@#CORRECT$%^>";
          for (x = 0; x < cor_param_arr.length; x++) {
            if (cor_param_arr[x] != "") {
              prep_param += "<&*>" + cor_param_arr[x];
            }
          }

          //PROCESSED CHECKING PARAMETER

          // alert(inc_param_arr);
          // alert(prep_param);
          // alert(input);

          //CHECK IF THERE ARE STRONG CHECKING PARAMETERS

          // alert("cor_param_arr: " + cor_param_arr.length);

          $.post(
            "zerver_page_teacher_update_check_param.php",
            { param: prep_param, q_id: hold_q_id },
            function () {
              $.post(
                "zerver_page_teacher_grade_and_check.php",
                { check_id: input, s_score: final_score },
                function () {
                  // alert("STUDENT ANSWER CHECKED");
                  //1 = checked by human
                  //2 = checked by computer
                  //3 = checked by human (required)
                }
              );
            }
          );

          if (cor_param_arr.length > 7) {
            $.post(
              "zerver_page_teacher_main_feature.php",
              { question_id: hold_q_id },
              function () {
                // alert(data); data
                alert("CHECKED AUTOMATICALLY");
              }
            );
          }

          // alert(inc_param_arr);
          // alert(cor_param_arr);
          // alert(arr_context.length)

          page_start();
        }
      );
    }
  );
}

function highlight_wrong(input) {
  input = input.replace("highlight_", "answer_id_");
  // alert(input);
  for (x = 0; x < document.getElementsByClassName(input).length; x++) {
    document.getElementsByClassName(input)[x].style.backgroundColor = "#FFFF00";
  }
}

function re_eval_cancel(input) {
  input = input.replace("re_eval_cancel_", "");
  // alert(input);
  $.post(
    "zerver_page_teacher_cancel_re_eval.php",
    { answer_id: input },
    function (data) {
      alert(data);
      page_start();
    }
  );
}

function re_eval_accept(input) {
  input = input.replace("re_eval_accept_", "");
  // alert(input);
  rescore = document.getElementById("re-score_" + input).value;
  $.post(
    "zerver_page_teacher_accept_re_eval.php",
    { answer_id: input, score: rescore },
    function (data) {
      alert(data);
      page_start();
    }
  );
}

function student_grades_reset_btn() {
  $.get("zerver_page_teacher_reset.php", function (data) {
    page_start();
    alert("GRADES RESET");
  });
}

$("#clear_auto_check").click(function () {
  empty_autocheck();
});

$("#fill_auto_check").click(function () {
  fill_autocheck();
});

function empty_autocheck() {
  $.get("zerver_page_teacher_autocheck_empty.php", function (data) {
    alert(data);
  });
}

function fill_autocheck() {
  $.get("zerver_page_teacher_autocheck_fill.php", function (data) {
    alert(data);
  });
}

function page_start() {
  $.get("zerver_in_no_company.php", function (data) {
    if (data == "") {
      window.location.href = "page_teacher_company.php";
    } else {
      room_page();
      $.get("zerver_page_teacher_no_pick.php", function (data) {
        if (data == "1") {
          document.getElementById("create-questions").style.visibility =
            "visible";
          document.getElementById("classroom-students").style.visibility =
            "visible";
          // document.getElementById("simulate").style.visibility = "visible";
        }
      });
      $.get("zerver_page_teacher_fetch_rooms.php", function (respo) {
        respo = JSON.parse(respo);
        // alert(data.length);
        if (respo.length == 0) {
          window.location.href = "page_create_change_room.php";
        }
      });
      $.get("zerver_page_teacher_room_change_show.php", function (data) {
        which_room = data;
        if (which_room == "") {
          return;
        }
        $.get("zerver_page_create_change_room_fetch.php", function (data) {
          data = JSON.parse(data);
          for (x = 0; x < data.length; x++) {
            if (data[x]["room_id"] == which_room) {
              which_room = data[x]["room_name"];
            }
          }
          document.getElementById("curr_class_section").innerHTML = which_room;
          $.get("zerver_page_teacher_fetch_re_eval.php", function (data) {
            // alert(data);
            data = JSON.parse(data);
            re_eval_html =
              "<h4>REQUESTED RE-EVALUATION</h4><br><div class='height-limiter' style='min-height: 40vh;'><table id='re_eval_table'><thead><tr><th style='width: 8%'>STUDENT</th><th style='width: 26%'>QUESTION</th><th style='width: 46%'>ANSWER</th><th style='width: 20%;'>ACTION</th></tr></thead><tbody>";
            for (x = 0; x < data.length; x++) {
              re_eval_html +=
                "<tr><td><img class='img-fluid' src='" +
                data[x]["profile_pic_address"] +
                "'/></td><td>" +
                data[x]["question"] +
                "</td><td>" +
                data[x]["answer"] +
                '</td><td><input id="re-score_' +
                data[x]["answer_id"] +
                '" type="number" min="0" max="100" value="0" step="any"/><br><button  id="re_eval_accept_' +
                data[x]["answer_id"] +
                '" onclick="re_eval_accept(this.id)">UPDATE</button><button id="re_eval_cancel_' +
                data[x]["answer_id"] +
                '" onclick="re_eval_cancel(this.id)">CANCEL</button></td></tr>';
            }
            re_eval_html += "</tbody></table></div><br><h4>EVALUATION</h4><br>";
            //######################################
            $.get("zerver_page_teacher_fetch_unchecked.php", function (data) {
              // alert(data);
              data = JSON.parse(data);
              unique_questions = [];
              for (x = 0; x < data.length; x++) {
                unique_questions[x] = data[x]["question_id"];
              }
              unique = (value, index, self) => {
                return self.indexOf(value) === index;
              };
              unique_questions = unique_questions.filter(unique);
              output1 = []; //set of questions
              output2 = []; //set of answers to those questions
              output3 = []; //answer_id_assigned
              for (x = 0; x < data.length; x++) {
                output3[x] = data[x]["answer_id"];
              }
              for (x = 0; x < unique_questions.length; x++) {
                for (y = 0; y < data.length; y++) {
                  if (data[y]["question_id"] == unique_questions[x]) {
                    output1[x] = data[y]["question"];
                  }
                }
              }
              for (x = 0; x < unique_questions.length; x++) {
                hold_arr1 = [];
                hold_arr2 = [];
                z = 0;
                for (y = 0; y < data.length; y++) {
                  if (data[y]["question_id"] == unique_questions[x]) {
                    hold_arr1[z] = data[y]["answer"];
                    hold_arr2[z] = data[y]["answer_id"];
                    z++;
                  }
                }
                output2[x] = hold_arr1;
                output3[x] = hold_arr2;
              }
              html_insertion = ``;
              for (x = 0; x < output1.length; x++) {
                //assign the questions and answers in html form.
                html_insertion +=
                  `<div class="height-limiter" style="min-height: 40vh;"><h5>` +
                  output1[x] +
                  `</h5><table style="width: 100%;"><thead><tr><th style="width: 85%;">STATEMENTS</th><th style="width: 15%;">ACTION</th></tr></thead><tbody>`;
                for (y = 0; y < output2[x].length; y++) {
                  spanner_arr = output2[x][y].split(" ");
                  spanned_str = "";
                  for (z = 0; z < spanner_arr.length; z++) {
                    spanner_arr[z] =
                      '<span id="' +
                      z +
                      '" class="answer_id_' +
                      output3[x][y] +
                      '" onmouseover="highlight_sentences(this.id, this.className)" onclick="enable_highlight(this.id, this.className)" onmouseout="unhighlight_sentences(this.id, this.className)" style="background-color: transparent;">' +
                      spanner_arr[z] +
                      " </span>";
                    spanned_str += spanner_arr[z];
                  }
                  html_insertion +=
                    `<tr><td>` +
                    spanned_str +
                    `</td><td><button id="highlight_` +
                    output3[x][y] +
                    `" onclick="highlight_wrong(this.id)">❗</button><button id="undo_id_` +
                    output3[x][y] +
                    `" onclick="undo_all(this.id)">⌫</button><button id="done_check_` +
                    output3[x][y] +
                    `" onclick="done_check(this.id)">✔</button></td></tr>`;
                }
                html_insertion += `</tbody></table></div>`;
              }
              document.getElementById("check-area").innerHTML =
                re_eval_html + html_insertion;
              // alert(document.getElementsByClassName("answer_id_3").length)
              $.get("zerver_page_teacher_all_grades.php", function (data) {
                // alert(data);
                data = JSON.parse(data);
                outcome = "";
                for (x = 0; x < data.length; x++) {
                  if (data[x]["checked"] != 0) {
                    outcome +=
                      "<tr><td><img src='" +
                      data[x]["profile_pic_address"] +
                      "' class='img-fluid'></td><td>" +
                      data[x]["username"] +
                      "</td><td>" +
                      data[x]["answer"] +
                      "</td><td>" +
                      data[x]["grades"] +
                      "</td><td>";
                    if (data[x]["checked"] == "1") {
                      outcome += "HUMAN</td><td>";
                    } else {
                      outcome += "MACHINE</td><td>";
                    }

                    outcome += data[x]["question"] + "</td><tr>";
                  }
                }

                document.getElementById("tbody_student_answers").innerHTML =
                  outcome;
              });
            });
          });
        });
      });
    }
  });
}

function room_page() {
  $.get("zerver_page_teacher_auto_room.php", function (data) {
    if (data == "0") {
      $.get("zerver_page_teacher_any_room.php", function (data) {
        data = JSON.parse(data);
        if (data.length == 0) {
          $.post(
            "zerver_page_create_change_room_param.php",
            {
              outcome: 0,
            },
            function () {
              window.location.href = "page_create_change_room.php";
            }
          );
        } else {
          $.get("zerver_page_teacher_no_pick.php", function (data) {
            // alert(data);
            if (data > 0) {
              return;
            }
            $.post(
              "zerver_page_create_change_room_param.php",
              {
                outcome: 1,
              },
              function () {
                window.location.href = "page_create_change_room.php";
              }
            );
          });
        }
      });
    }
  });
}

page_start();
